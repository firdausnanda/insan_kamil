<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index() {
        $produk_laris = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->limit(5)->get();
        $produk_baru = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->limit(12)->get();
        $kategori = Kategori::all();
        $slide = Slideshow::where('status', 1)->orderBy('urutan', 'asc')->get();
        return view('pages.landing.index', compact('produk_laris', 'produk_baru', 'kategori', 'slide'));
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
                $produks = $produk_collect->whereIn('rating', $rentang);
                    
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
        $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori')->where('id', $id)->first();
        $produk_related = Produk::with('harga', 'stok', 'gambar_produk')->where('id_kategori', $produk->id_kategori)->orderBy('created_at', 'desc')->limit(5)->get();
        return view('pages.landing.detail', compact('produk', 'produk_related'));
    }
}
