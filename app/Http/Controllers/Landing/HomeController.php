<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Harga;
use App\Models\Kategori;
use App\Models\Popup;
use App\Models\Produk;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index() 
    {
        $produk_laris = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->limit(5)->get();
        $produk_baru = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->limit(12)->get();
        $kategori = Kategori::all();
        $slide = Slideshow::where('status', 1)->orderBy('urutan', 'asc')->get();
        $blog = Blog::where('status', 1)->latest()->limit(4)->get();

        // Promo
        $promo_raw = Produk::with('harga', 'stok', 'gambar_produk')->whereHas('harga', function ($q){
            $q->where('selesai_diskon', '>=', now());
        })->get();

        foreach ($promo_raw as $k => $v) {
            $hitung = $v->harga->diskon / $v->harga->harga_awal * 100;
            $promo_raw[$k]->persen = (int) floor($hitung);
        }
        
        $data_promo = $promo_raw->sortByDesc('persen');
        $promo = $data_promo->values()->all()[0];

        // dd($promo);

        return view('pages.landing.index', compact('produk_laris', 'produk_baru', 'kategori', 'slide', 'blog', 'promo'));
    }
    
    public function kategori($kategori, Request $request) 
    {
        $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori')->whereHas('kategori', function($query) use($kategori){
            $query->where('slug', $kategori);
        })->orderBy('created_at', 'desc')->paginate(10);

        $kategori_all = Kategori::get();
        $slug = $kategori_all->where('slug', $kategori)->first();

        if ($request->ajax()) {

            if ($request->filter) {
                
                switch ($request->sort) {
                    case 1:
                        $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'ratings')->whereHas('kategori', function($query) use($kategori){
                            $query->where('slug', $kategori);
                        })
                        ->orderBy('created_at', 'desc');
                        // ->paginate(10);
                        break;
                    case 2:
                        $produk = Produk::with('stok', 'gambar_produk', 'kategori', 'ratings')->whereHas('kategori', function($query) use($kategori){
                            $query->where('slug', $kategori);
                        })->with(['harga' => function($q){
                            $q->orderBy('harga_akhir', 'asc');
                        }]);
                        // ->paginate(10);
                        break;
                    case 3:
                        $produk = Produk::with('stok', 'gambar_produk', 'kategori', 'ratings')->whereHas('kategori', function($query) use($kategori){
                            $query->where('slug', $kategori);
                        })->with(['harga' => function($q){
                            $q->orderBy('harga_akhir', 'desc');
                        }]);
                        // ->paginate(10);
                        break;                
                }

                // Get Rentang Harga
                $harga1 = (int) filter_var($request->slide[0], FILTER_SANITIZE_NUMBER_INT); 
                $harga2 = (int) filter_var($request->slide[1], FILTER_SANITIZE_NUMBER_INT); 

                if ($harga2 > 1000) {
                    $produk->whereHas('harga', function($q) use($harga1, $harga2) {
                        $q->where('harga_akhir', '>=', $harga1)->where('harga_akhir', '<=', $harga2);
                    });
                }

                // Paginate
                $produk_collect = $produk->paginate(10);

                // Add Avg Produk Rating to each produk 
                foreach ($produk_collect as $k => $v) {
                    $produk_collect[$k]->rating = floor($v->averageRating());
                }
                
                // Get Rentang Rating
                $rentang = array_values(array_filter([$request->rating1, $request->rating2, $request->rating3, $request->rating4, $request->rating5]));
                if ($rentang) {
                    $produks = $produk_collect->whereIn('rating', $rentang);
                }else{
                    $produks = $produk_collect;
                }
                    
                $render = View::make('pages.landing.produk-card-filter', compact('produks'))->render();
    
                return ResponseFormatter::success($render, 'data berhasil diambil');

            }

            switch ($request->sort) {
                case 1:
                    $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori')->whereHas('kategori', function($query) use($kategori){
                        $query->where('slug', $kategori);
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                    break;
                case 2:
                    $produk = Produk::with('stok', 'gambar_produk', 'kategori')->whereHas('kategori', function($query) use($kategori){
                        $query->where('slug', $kategori);
                    })->with(['harga' => function($q){
                        $q->orderBy('harga_akhir', 'asc');
                    }])
                    ->paginate(10);
                    break;
                case 3:
                    $produk = Produk::with('stok', 'gambar_produk', 'kategori')->whereHas('kategori', function($query) use($kategori){
                        $query->where('slug', $kategori);
                    })->with(['harga' => function($q){
                        $q->orderBy('harga_akhir', 'desc');
                    }])
                    ->paginate(10);
                    break;                
            }

            $render = View::make('pages.landing.produk-card', compact('produk'))->render();

            return ResponseFormatter::success($render, 'data berhasil diambil');
        }

        return view('pages.landing.produk-by-kategori', compact('produk', 'kategori_all', 'slug'));
    }
    
    public function detail($id) 
    {
        try {
            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'penerbit')->where('id', $id)->first();
            $produk_related = Produk::with('harga', 'stok', 'gambar_produk')->where('id_kategori', $produk->id_kategori)->orderBy('created_at', 'desc')->limit(5)->get();
            return view('pages.landing.detail', compact('produk', 'produk_related'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function detail_blog($id)
    {
        try {
            $b = Blog::where('id', $id)->first();
            return view('pages.landing.blog', compact('b'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function detail_popup(Request $request)
    {
        
        try {

            $kategori_all = Kategori::get();
            
            $popup = Popup::first();
            
            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'ratings')->get(); 
            
            foreach ($produk as $key => $value) {
                // Add Persen to Produk
                $hitung = $value->harga->diskon / $value->harga->harga_awal * 100;
                $produk[$key]->persen = floor($hitung);
            }
    
            $produk = $produk->where('persen', '>=', $popup->diskon);
                
            if ($request->ajax()) {
                // Render View
                $render = View::make('pages.landing.produk-card', compact('produk'))->render();    
                return ResponseFormatter::success($render, 'data berhasil diambil'); 
            }

            return view('pages.landing.produk-by-popup', compact('kategori_all'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }
}
