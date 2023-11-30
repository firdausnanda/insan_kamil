<?php

namespace App\Http\Controllers\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\TempOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class OrderController extends Controller
{
        
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


        if ($data->first() != '') {
            return view('pages.user.keranjang.checkout', compact('data', 'subTotal', 'beratProduk'));
        }else{
            return redirect()->route('user.keranjang.index');
        }
    }

    public function store(Request $request)
    {
        try {

            foreach ($request->dataProduk as $v) {
                
                // Store ke Order
                // $order = Order::create([
                //     'id_produk' => $v['id_produk'],
                //     'id_user' => $v['id_user'],
                //     'harga_jual' => $v['harga'],
                //     'jumlah_produk' => $v['jumlah'],
                // ]);

                // Hapus dari Keranjang
                // $keranjang = Keranjang::where('id', $v['id_keranjang'])->delete();
            }


            return ResponseFormatter::success('sukses', 'data berhasil disimpan');

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
                // Store ke Order
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
}
