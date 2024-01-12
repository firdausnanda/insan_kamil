<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $order = Order::with('user')->where('status', $request->status)->get();
            return ResponseFormatter::success($order, 'Data berhasil diambil!');
        }
        return view('pages.admin.order.index');
    }
    
    public function detail($id) 
    {
        $order = Order::with('user.province', 'user.city', 'user.district', 'produk_dikirim.produk.gambar_produk')->where('id', $id)->first();

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

        return view('pages.admin.order.detail', compact('order', 'subTotal', 'courier_search'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'no_resi' => 'string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Kategori tidak valid', 422);
		}

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

                $waybill = Http::withHeaders([
                    'key' => env('RAJAONGKIR_API_KEY')
                ])->post('https://pro.rajaongkir.com/api/waybill',[
                    'waybill' => $request->waybill,
                    'courier' => $request->courier
                ])->json();

                $tracking = $waybill['rajaongkir']['result'];

                return ResponseFormatter::success($tracking, 'Data berhasil diambil!');
            }

            return '';

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }

    }
}
