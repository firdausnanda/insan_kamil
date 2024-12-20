<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::select('id')->get();
        return ResponseFormatter::success($produk);
    }

    public function show(Request $request)
    {
        $produk = Produk::with('kategori', 'penerbit', 'harga', 'stok', 'bahasa', 'gambar_produk')->where('id', $request->id)->first();
        return ResponseFormatter::success($produk);
    }
}
