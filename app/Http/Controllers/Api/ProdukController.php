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

    public function show($id)
    {
        $produk = Produk::with('kategori', 'penerbit', 'harga', 'stok', 'bahasa')->where('id', $id)->first();
        return ResponseFormatter::success($produk);
    }
}
