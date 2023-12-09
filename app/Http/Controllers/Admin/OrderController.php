<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $order = Order::with('user')->where('status', $request->status)->get();
            return ResponseFormatter::success($order, 'Data berhasil diambil!');
        }
        return view('pages.admin.order.index');
    }
    
    public function detail() {
        return view('pages.admin.order.detail');
    }
}
