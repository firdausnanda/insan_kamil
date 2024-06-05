<?php

namespace App\Http\Controllers\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Models\Keranjang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $cek_keranjang = Keranjang::with('produk.harga', 'produk.stok', 'produk.gambar_produk')->where('id_user', $request->id_user)->get();
        //     return ResponseFormatter::success($cek_keranjang, 'Data berhasil diambil!');
        // }
        // return view('pages.user.keranjang.index');

        $cek_keranjang = Keranjang::with('produk.harga', 'produk.stok', 'produk.gambar_produk')->where('id_user', Auth::user()->id)->get();
        
        $subTotal = $cek_keranjang->sum(function($q) {
            return $q->jumlah_produk * $q->produk->harga->harga_akhir; 
        });
        
        // dd($cek_keranjang->where('jumlah_produk', '>', 2));
        
        return view('pages.user.keranjang.index2', compact('cek_keranjang', 'subTotal'));
    }

    public function subtotal() 
    {
        $cek_keranjang = Keranjang::with('produk.harga', 'produk.stok', 'produk.gambar_produk')->where('id_user', Auth::user()->id)->get();
        
        $subTotal = $cek_keranjang->sum(function($q) {
            return $q->jumlah_produk * $q->produk->harga->harga_akhir; 
        });

        // Cek Produk yang termasuk dalam diskon event
        $cekDiskon = Diskon::with('produk')
                ->whereHas('produk', function($query) use ($cek_keranjang){
                    $query->whereIn('id_produk', $cek_keranjang->pluck('id_produk'));
                })
                ->where('status', 2)
                ->where('mulai_diskon', '<=', Carbon::now())
                ->where('selesai_diskon', '>=', Carbon::now())
                ->first();

        // Diskon Member
        if ($cekDiskon) {
            $member_diskon = 0;
        }elseif($cek_keranjang[0]->user->id_member){
            $member_diskon = $subTotal * $cek_keranjang[0]->user->member->diskon / 100;
        }elseif ($subTotal >= 50000) {
            $member_diskon = $subTotal * 10 / 100;
        }else{
            $member_diskon = 0;
        }

        return ResponseFormatter::success([$subTotal, $member_diskon], 'data berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'id_user' => 'required|string|max:255',
			'id_produk' => 'required|string|max:255',
			'jumlah' => 'required|numeric',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            // Cek Jika User & Produk Sudah Ada
            $cek_keranjang = Keranjang::where('id_user', $request->id_user)->where('id_produk', $request->id_produk)->first();
            if ($cek_keranjang != null) {
                // Jumlahkan Total Produk
                $total = $request->jumlah + $cek_keranjang->jumlah_produk;
                $keranjang = $cek_keranjang->update([
                    'jumlah_produk' => $total
                ]);
            }else{
                $keranjang = Keranjang::create([
                    'id_user' => $request->id_user,
                    'id_produk' => $request->id_produk,
                    'jumlah_produk' => $request->jumlah
                ]);
            }
            return ResponseFormatter::success($keranjang, 'Data Berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }

    public function destroy(Request $request)
    {
        try {
            $k = Keranjang::where('id', $request->id_keranjang)->delete();
            return ResponseFormatter::success($k, 'Data Berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
