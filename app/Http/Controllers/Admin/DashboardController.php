<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $quote = Inspiring::quote();

        // Tanggal awal dan akhir bulan ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Total Transaksi 1 Bulan Terakhir
        $total_transaksi = Pembayaran::where('status_pembayaran', 2)
                                ->whereBetween('updated_at', [$startDate, $endDate])
                                ->sum('harga_jual');

        // Total Order 1 bulan terakhir
        $jumlah_order = Order::with('user', 'pembayaran')->where('status', '>=', 2)->orderBy('created_at', 'desc')->get();
        $jumlah_order_bulan_ini = $jumlah_order->whereBetween('created_at', [$startDate, $endDate])->count();

        // Jumlah Customer
        $customer = User::whereHas('roles', function($query){
            $query->where('name', 'user');
        })->get();
        $customer_bulan_ini = $customer->whereBetween('created_at', [$startDate, $endDate])->count();

        // Table Transaksi terbaru
        if ($request->ajax()) {
            $transaksi_terakhir = $jumlah_order->whereBetween('created_at', [$startDate, $endDate]);
            return ResponseFormatter::success($transaksi_terakhir, 'Data berhasil diambil');
        }

        return view('pages.admin.dashboard.index', compact('quote', 'total_transaksi',
                                                    'jumlah_order', 'jumlah_order_bulan_ini',
                                                    'customer', 'customer_bulan_ini'));
    }
}
