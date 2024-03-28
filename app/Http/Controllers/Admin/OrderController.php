<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Dropship;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            if ($request->status == 6) {
                $order = Order::with('user', 'member', 'pembayaran', 'bukti_transaksi')
                                ->withSum('pembayaran', 'harga_jual')
                                ->has('bukti_transaksi')
                                ->where('status', 1)
                                ->orderBy('created_at', 'desc')
                                ->get();
                return ResponseFormatter::success($order, 'Data berhasil diambil!');
            }
            $order = Order::with('user', 'member', 'pembayaran')->withSum('pembayaran', 'harga_jual')->where('status', $request->status)->orderBy('created_at', 'desc')->get();
            return ResponseFormatter::success($order, 'Data berhasil diambil!');
        }
        return view('pages.admin.order.index');
    }
    
    public function detail($id) 
    {
        $order = Order::with('user.province', 'user.city', 'user.district', 'produk_dikirim.produk.gambar_produk')->where('id', $id)->first();
        $dropship = Dropship::where('id_order', $id)->first();
        
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

        foreach ($courier as $c) {
            if ($c['kode'] == $order->courier) {
                $courier_search = $c['nama'];
            }
        }
            
        // harga produk total
        $subTotal = $order->produk_dikirim->sum(function($q) {
            return $q['jumlah_produk'] * $q['harga_jual']; 
        });

        if ($order->is_flash == 1) {
            $member_diskon = 0;
        }elseif($order->id_member){
            $member_diskon = $subTotal * $order->member->diskon / 100;
        }elseif ($subTotal >= 50000) {
            $member_diskon = $subTotal * 10 / 100;
        }else{
            $member_diskon = 0;
        }

        // Diskon Alquran
        $diskon_alquran = 0;
        foreach ($order->produk_dikirim as $key => $value) {
            // Diskon Alquran
            if ($value->produk->id_kategori == '17') {
                if ($order->id_member) {
                    $diskon_alquran += $value->harga_jual * $value->jumlah_produk * 30 / 100;
                }else{
                    $diskon_alquran += $value->harga_jual * $value->jumlah_produk * 20 / 100;
                }
            }
        }

        return view('pages.admin.order.detail', compact('order', 'subTotal', 'courier_search', 
                                                        'dropship', 'member_diskon',
                                                        'diskon_alquran'));
    }

    public function store(Request $request)
    {
        try {
            
            $order = Order::where('id', $request->id_order)->update([
                'no_resi' => $request->no_resi,
                'status' => $request->status
            ]);

            return ResponseFormatter::success($order, 'Data berhasil disimpan!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    
    public function waybill(Request $request)
    {
        try {

            if ($request->waybill != '') {

                // Raja Ongkir
                // $waybill = Http::withHeaders([
                //     'key' => env('RAJAONGKIR_API_KEY')
                // ])->post('https://pro.rajaongkir.com/api/waybill',[
                //     'waybill' => $request->waybill,
                //     'courier' => $request->courier
                // ])->json();

                // Binderbyte
                $waybill = Http::get('http://api.binderbyte.com/v1/track',[
                    'api_key' => '3bfb848a4ae0da02a5534152b07c10050610993801b1c177cd48db46d6e99174',
                    'awb' => $request->waybill,
                    'courier' => $request->courier
                ])->json();

                // Raja Ongkir
                // $tracking = $waybill['rajaongkir']['result'];
                
                // Binderbyte
                if ($request->courier == 'ambil_gudang') {
                    $tracking = [
                        [
                            "date" => '',
                            "desc" => 'diambil di gudang.'
                        ]
                    ];
                }else{
                    $tracking = $waybill['data']['history'];
                }

                return ResponseFormatter::success($tracking, 'Data berhasil diambil!');
            }

            return '';

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }

    }
}
