<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        // harga produk total
        $subTotal = $order->produk_dikirim->sum(function($q) {
            return $q['jumlah_produk'] * $q['harga_jual']; 
        });

        return view('pages.admin.order.detail', compact('order', 'subTotal'));
    }

    public function store(Request $request)
    {
        try {
            $order = Order::where('id', $request->id_order)->first();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
