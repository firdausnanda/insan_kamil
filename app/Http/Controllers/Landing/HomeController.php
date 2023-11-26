<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $produk_laris = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->limit(5)->get();
        $produk_baru = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->limit(12)->get();
        $kategori = Kategori::all();
        return view('pages.landing.index', compact('produk_laris', 'produk_baru', 'kategori'));
    }
    
    public function detail($id) {
        $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori')->where('id', $id)->first();
        $produk_related = Produk::with('harga', 'stok', 'gambar_produk')->where('id_kategori', $produk->id_kategori)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('pages.landing.detail', compact('produk', 'produk_related'));
    }
}
