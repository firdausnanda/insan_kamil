<?php

namespace App\Http\Controllers\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\ProdukDikirim;
use App\Models\TempOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Midtrans\Snap;

class OrderController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }
        
    public function index() 
    {

        $data = TempOrder::with('user.province', 'user.city', 'produk.gambar_produk')->whereHas('user', function($query){
            $query->where('id', Auth::user()->id);
        })->get();

        $subTotal = $data->sum(function($q) {
           return $q->jumlah_produk * $q->harga_jual; 
        });

        $beratProduk = $data->sum(function($q) {
            return $q->jumlah_produk * $q->berat_produk; 
        });

        switch (env('RAJAONGKIR_PACKAGE')) {
            case 'starter':
                $courier = config('rajaongkir.courier.starter');
                break;
            case 'basic':
                $courier = config('rajaongkir.courier.basic');
                break;
            case 'pro':
                $courier = config('rajaongkir.courier.pro');
                break;            
            default:
                $courier = null;
                break;
        }

        if ($data->first() != '') {
            return view('pages.user.keranjang.checkout', compact('data', 'subTotal', 'beratProduk', 'courier'));
        }else{
            return redirect()->route('user.keranjang.index');
        }
    }

    public function store(Request $request)
    {
        try {

            $collect = collect($request->data);

            // harga produk total
            $subTotal = $collect->sum(function($q) {
                return $q['jumlah_produk'] * $q['harga_jual']; 
            });

            // berat produk total
            $beratProduk = $collect->sum(function($q) {
                return $q['jumlah_produk'] * $q['berat_produk']; 
            });

            // Create Order
            $order = Order::create([
                'id_user' => $request->user,
                'harga_total' => $subTotal,
                'jumlah_produk_total' => $beratProduk,
                'courier' => $request->courier,
                'biaya_pengiriman' => $request->biaya_pengiriman,
                'origin' => $request->origin,
                'destination' => $request->destination,
            ]);

            // Create Produk Dikirim
            foreach ($request->data as $v) {
                ProdukDikirim::create([
                    'id_order' => $order->id,
                    'id_produk' => $v['id_produk'],
                    'harga_jual' => $v['harga_jual'],
                    'jumlah_produk' => $v['jumlah_produk'],
                ]);
            }

            // cek order User
            $cekOrder = Order::with('user')->where('id', $order->id)->first();

            $payload = [
                'transaction_details' => [
                    'order_id'     => $order->id,
                    'gross_amount' => $order->harga_total + $order->biaya_pengiriman,
                ],
                'customer_details' => [
                    'first_name' => $cekOrder->user->name,
                    'email'      => $cekOrder->user->email,
                ],
                'item_details' => [
                    [
                        'id'            => $order->id,
                        'name'          => 'Transaksi Order - ' . $order->id,
                        'price'         => $order->harga_total + $order->biaya_pengiriman,
                        'quantity'      => 1,
                    ],
                ],
            ];

            // MidTrans
            $snapToken = Snap::getSnapToken($payload);

            // Create Pembayaran
            Pembayaran::create([
                'id_order' => $order->id,
                'status_pembayaran' => 1,
                'snap_token' => $snapToken,
                'harga_jual' => $order->harga_total + $order->biaya_pengiriman,
                'jumlah_produk' => $beratProduk,
            ]);

            return ResponseFormatter::success($snapToken, 'data berhasil disimpan');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function temp(Request $request)
    {
        try {

            // Remove TempOrder if exist
            TempOrder::where('id_user', $request->id_user)->delete();

            foreach ($request->dataProduk as $v) {
                // Store ke Temp Order
                $order = TempOrder::create([
                    'id_produk' => $v['id_produk'],
                    'id_user' => $request->id_user,
                    'harga_jual' => $v['harga'],
                    'berat_produk' => $v['berat_produk'],
                    'jumlah_produk' => $v['jumlah'],
                ]);
            }

            return ResponseFormatter::success($order, 'Data Tersimpan!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function beli(Request $request)
    {
        try {
            
            // Remove TempOrder if exist
            TempOrder::where('id_user', $request->id_user)->delete();

            $produk = Produk::with('harga')->where('id', $request->id_produk)->first();

            // Store ke Temp Order
            $order = TempOrder::create([
                'id_produk' => $request->id_produk,
                'id_user' => $request->id_user,
                'harga_jual' => $produk->harga->harga_akhir,
                'berat_produk' => $produk->berat_produk,
                'jumlah_produk' => $request->jumlah,
            ]);

            return ResponseFormatter::success($order, 'Data Tersimpan!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }

    public function ongkir(Request $request)
    {
        try {

            $cost = RajaOngkir::ongkosKirim([
                'origin'            => config('rajaongkir.origin'), // ID kota/kabupaten asal
                'destination'       => $request->city_destination, // ID kota/kabupaten tujuan
                'weight'            => $request->weight, // berat barang dalam gram
                'courier'           => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();

            return ResponseFormatter::success($cost, 'Data berhasil diambil!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }
    }

    public function konfirmasi()
    {
        return view('pages.user.keranjang.konfirmasi');
    }
}
