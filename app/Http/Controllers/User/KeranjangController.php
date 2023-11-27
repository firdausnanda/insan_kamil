<?php

namespace App\Http\Controllers\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KeranjangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cek_keranjang = Keranjang::with('produk.harga', 'produk.stok', 'produk.gambar_produk')->where('id_user', $request->id_user)->get();
            // dd($cek_keranjang);
            return ResponseFormatter::success($cek_keranjang, 'Data berhasil diambil!');
        }
        return view('pages.user.keranjang.index');
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
}
