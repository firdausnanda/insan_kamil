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
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $quote = Inspiring::quote();

        // Tanggal awal dan akhir bulan ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();

        $transaksi = Pembayaran::where('status_pembayaran', 2)->get();

        // Total Transaksi 1 Bulan Terakhir
        $total_transaksi = $transaksi->whereBetween('updated_at', [$startDate, $endDate])
                                ->sum('harga_jual');

        // Total Order 1 bulan terakhir
        $jumlah_order = Order::with('user', 'pembayaran')->where('status', '>=', 2)->orderBy('created_at', 'desc')->get();
        $jumlah_order_bulan_ini = $jumlah_order->whereBetween('created_at', [$startDate, $endDate])->count();

        // Jumlah Customer
        $customer = User::whereHas('roles', function($query){
            $query->where('name', 'user');
        })->get();
        $customer_bulan_ini = $customer->whereBetween('created_at', [$startDate, $endDate])->count();

        // Persentase Pendapatan
        $pendapatan_tahun_lalu = $transaksi
                                    ->whereBetween('created_at', [$awalTahun->subYear(), $akhirTahun->subYear()])
                                    ->sum('harga_jual');
                                    
        $pendapatan_tahun_ini = $transaksi
                                    ->whereBetween('created_at', [$awalTahun, $akhirTahun])
                                    ->sum('harga_jual');
        
        if ($pendapatan_tahun_ini > $pendapatan_tahun_lalu) {
            // persentase keuntungan
            $persentase_transaksi[] = ($pendapatan_tahun_ini - $pendapatan_tahun_lalu) / $pendapatan_tahun_ini * 100;
            $persentase_transaksi[] = '+';
        }elseif ($pendapatan_tahun_ini < $pendapatan_tahun_lalu) {
            // persentase kerugian
            $persentase_transaksi[] = $pendapatan_tahun_lalu - $pendapatan_tahun_ini / $pendapatan_tahun_ini * 100;
            $persentase_transaksi[] = '-';
        }else{
            $persentase_transaksi[] = 0;
            $persentase_transaksi[] = '';
        }

        if ($request->ajax()) {
            
            if ($request->chart == 1) {
                
                // Bulan
                $transaksi_bulan = Pembayaran::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(harga_jual) as total'))
                                    ->whereBetween('created_at', [$awalTahun->subYear(), Carbon::now()])
                                    ->groupBy(DB::raw('MONTH(created_at)'))
                                    ->get();

                $data = $transaksi_bulan->map(function ($item, $key) {
                    
                    $tanggal = Carbon::create(null, $item->bulan, 1);
                    $namaBulan = $tanggal->locale('id')->isoFormat('MMMM');

                    return [
                        'bulan' => $namaBulan, 
                        'total' => floor($item->total / 1000) 
                    ];
                });

                return ResponseFormatter::success($data, 'Data berhasil diambil');
            }elseif ($request->chart == 2) {
                
                $order = Order::select('status', DB::raw('COUNT(status) as total'))
                                    ->whereBetween('created_at', [$awalTahun->subYear(), Carbon::now()])
                                    ->where('status', '>=', 2)
                                    ->orderBy('status')
                                    ->groupBy('status')
                                    ->get();

                $data = $order->map(function ($item, $key) {
                    
                    switch ($item->status) {
                        case 2:
                            $status = 'Order';
                            break;
                        case 3:
                            $status = 'Pengemasan';
                            break;
                        case 4:
                            $status = 'Pengiriman';
                            break;
                        case 5:
                            $status = 'Selesai';
                            break;
                            
                        default:
                            $status = 'Belum Dibayar';
                            break;
                    }

                    return [
                        'status' => $status, 
                        'total' => $item->total 
                    ];
                });

                return ResponseFormatter::success($data, 'Data berhasil diambil');
            }

            // Table Transaksi terbaru
            $transaksi_terakhir = $jumlah_order->whereBetween('created_at', [$startDate, $endDate]);
            return ResponseFormatter::success($transaksi_terakhir, 'Data berhasil diambil');
        }

        return view('pages.admin.dashboard.index', compact('quote', 'total_transaksi',
                                                    'jumlah_order', 'jumlah_order_bulan_ini',
                                                    'customer', 'customer_bulan_ini',
                                                    'persentase_transaksi'));
    }
}
