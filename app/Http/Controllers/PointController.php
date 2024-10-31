<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Order;
use App\Models\RewardPoint;
use App\Models\RiwayatReedem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PointController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $order = Order::where('id_user', $user->id)
            ->where('status', '>=', 2)
            ->where('status', '!=', 6)
            ->withSum('pembayaran', 'harga_jual')
            ->with('produk_dikirim.produk')
            ->orderBy('created_at', 'desc')
            ->get();

        // Total Order Keseluruhan
        $total_order = $order->sum('pembayaran_sum_harga_jual');

        $order_atas_50000 = $order->filter(function ($order) {
            return $order->pembayaran_sum_harga_jual > 50000;
        });

        // Grouping Order Order diatas 50 Ribu
        $groupedOrders = $order_atas_50000->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->locale('id')->isoFormat('MMMM, YYYY');
        });

        return view('pages.user.point.index', compact('user', 'total_order', 'groupedOrders', 'order_atas_50000'));
    }

    public function redeem()
    {
        $user = auth()->user();
        $order = Order::where('id_user', $user->id)->where('status', '>=', 2)->where('status', '!=', 6)->withSum('pembayaran', 'harga_jual')->get();
        $total_order = $order->sum('pembayaran_sum_harga_jual');
        $reward = RewardPoint::where('is_active', 1)->get();
        return view('pages.user.point.redeem', compact('user', 'reward', 'total_order'));
    }

    public function redeem_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_reward' => 'required',
            'nama_pemilik' => 'required',
            'no_rekening' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        try {
            $user = Auth::user();

            // Cek Riwayat Redeem
            $cekRiwayat = RiwayatReedem::where('id_user', $user->id)
                ->where('id_reward', $request->id_reward)
                ->first();
            if ($cekRiwayat) {
                return redirect()->back()->with('error', 'Poin sudah pernah di redeem');
            }

            // Cek Reward
            $cekReward = RewardPoint::where('id', $request->id_reward)->first();
            if ($cekReward->total_point > $user->point) {
                return redirect()->back()->with('error', 'Poin tidak cukup');
            }
 
            // Upload Gambar
            if ($request->hasFile('gambar')) {
                
                $file = $request->file('gambar');
                $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());

                // Store Image
                $path = Storage::putFileAs(
                    'public/bukti_redeem',
                    $request->file('gambar'),
                    $fileName
                );
            }else{
                return redirect()->back()->with('error', 'Gambar tidak boleh kosong');
            }

            // Create Riwayat Redeem
            RiwayatReedem::create([
                'id_user' => $user->id,
                'id_reward' => $request->id_reward,
                'nama' => $cekReward->nama,
                'point_total' => $cekReward->point_total,
                'harga_total' => $cekReward->harga_total ?? 0,
                'deskripsi' => $cekReward->deskripsi,
                'gambar' => $cekReward->gambar,
                'keterangan' => $cekReward->keterangan,
                'nama_pemilik' => $request->nama_pemilik,
                'no_rekening' => $request->no_rekening,
                'ktp' => $fileName,
                'status' => 1,
            ]);

            return redirect()->route('user.point.history')->with('success', 'Poin berhasil di redeem');
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function history(Request $request)
    {
        $user = auth()->user();
        $reward = RiwayatReedem::where('id_user', $user->id)->with('reward')->get();
        $order = Order::where('id_user', $user->id)->where('status', '>=', 2)->where('status', '!=', 6)->withSum('pembayaran', 'harga_jual')->get();
        $total_order = $order->sum('pembayaran_sum_harga_jual');

        if ($request->ajax()) {
            return ResponseFormatter::success($reward, 'Data berhasil diambil');
        }

        return view('pages.user.point.history', compact('user', 'reward', 'total_order'));
    }
}
