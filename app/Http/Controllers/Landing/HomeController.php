<?php

namespace App\Http\Controllers\Landing;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Diskon;
use App\Models\GroupMenu;
use App\Models\Harga;
use App\Models\Kategori;
use App\Models\Member;
use App\Models\Penerbit;
use App\Models\Popup;
use App\Models\Produk;
use App\Models\Rating;
use App\Models\Slideshow;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        // Buku Best Seler
        $produk_laris = Produk::with('harga', 'stok', 'gambar_produk')
            ->withSum('produk_dikirim', 'jumlah_produk')
            ->orderBy('produk_dikirim_sum_jumlah_produk', 'desc')
            ->where('status', 1)->limit(8)->get();

        if ($produk_laris->count() < 5) {
            $produk_laris = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->where('status', 1)->limit(5)->get();
        }

        // New Produk
        $produk_baru = Produk::with('harga', 'stok', 'gambar_produk')->where('status', 1)->orderBy('created_at', 'desc')->limit(8)->get();

        $penerbit = Penerbit::all();
        $kategori = Kategori::all();
        $slide = Slideshow::where('status', 1)->orderBy('urutan', 'asc')->get();
        $blog = Blog::where('status', 1)->latest()->limit(4)->get();

        // Promo
        $promo_raw = Produk::with('harga', 'stok', 'gambar_produk', 'produk_dikirim.order_dibayar')->whereHas('harga', function ($q) {
            $q->where('mulai_diskon', '<=', now())->where('selesai_diskon', '>=', now());
        })->where('status', 1)->get();

        foreach ($promo_raw as $k => $v) {
            $hitung = $v->harga->diskon / $v->harga->harga_awal * 100;
            $promo_raw[$k]->persen = (int) floor($hitung);
        }

        if (count($promo_raw) > 0) {
            $data_promo = $promo_raw->sortByDesc('persen');
            $promo = $data_promo->values()->all()[0];
        } else {
            $promo = '';
        }

        // Menu All
        $menu_all = GroupMenu::with('produk.harga', 'produk.stok', 'produk.gambar_produk')->where('status', 1)->get();

        // Menu Group
        $menu = $menu_all->where('preorder', 0);

        // Menu Preorder 
        $preorder = $menu_all->where('preorder', 1);

        // Flash Sale
        $flash_sale = Diskon::where('status', 2)->first();

        if ($flash_sale && now() >= $flash_sale->mulai_diskon && now() <= $flash_sale->selesai_diskon) {

            $flash = Produk::with('harga', 'stok', 'gambar_produk')->whereHas('diskon', function ($query) use ($flash_sale) {
                $query->where('id_diskon', $flash_sale->id);
            })->get();
        } else {
            $flash = null;
        }

        return view('pages.landing.index', compact(
            'produk_laris',
            'produk_baru',
            'kategori',
            'slide',
            'blog',
            'promo',
            'menu',
            'flash',
            'flash_sale',
            'penerbit',
            'preorder'
        ));
    }

    public function kategori($kategori, Request $request)
    {
        try {
            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori')->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('slug', $kategori);
            })->orderBy('created_at', 'desc')->where('status', 1)->paginate(10);

            $kategori_all = Kategori::get();
            $slug = $kategori_all->where('slug', $kategori)->first();

            if (!$slug) {
                abort(404);
            }

            if ($request->ajax()) {

                if ($request->filter) {

                    switch ($request->sort) {
                        case 1:
                            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'ratings')->whereHas('kategori', function ($query) use ($kategori) {
                                $query->where('slug', $kategori);
                            })
                                ->orderBy('created_at', 'desc')
                                ->where('status', 1);
                            // ->paginate(10);
                            break;
                        case 2:
                            $produk = Produk::with('stok', 'gambar_produk', 'kategori', 'ratings')->whereHas('kategori', function ($query) use ($kategori) {
                                $query->where('slug', $kategori);
                            })->with(['harga' => function ($q) {
                                $q->orderBy('harga_akhir', 'asc');
                            }])->where('status', 1);
                            // ->paginate(10);
                            break;
                        case 3:
                            $produk = Produk::with('stok', 'gambar_produk', 'kategori', 'ratings')->whereHas('kategori', function ($query) use ($kategori) {
                                $query->where('slug', $kategori);
                            })->with(['harga' => function ($q) {
                                $q->orderBy('harga_akhir', 'desc');
                            }])->where('status', 1);
                            // ->paginate(10);
                            break;
                    }

                    // Get Rentang Harga
                    $harga1 = (int) filter_var($request->slide[0], FILTER_SANITIZE_NUMBER_INT);
                    $harga2 = (int) filter_var($request->slide[1], FILTER_SANITIZE_NUMBER_INT);

                    if ($harga2 > 1000) {
                        $produk->whereHas('harga', function ($q) use ($harga1, $harga2) {
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
                    } else {
                        $produks = $produk_collect;
                    }

                    $render = View::make('pages.landing.produk-card-filter', compact('produks'))->render();

                    return ResponseFormatter::success($render, 'data berhasil diambil');
                }

                switch ($request->sort) {
                    case 1:
                        $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori')->whereHas('kategori', function ($query) use ($kategori) {
                            $query->where('slug', $kategori);
                        })
                            ->orderBy('created_at', 'desc')
                            ->where('status', 1)
                            ->paginate(10);
                        break;
                    case 2:
                        $produk = Produk::with('stok', 'gambar_produk', 'kategori')->whereHas('kategori', function ($query) use ($kategori) {
                            $query->where('slug', $kategori);
                        })->with(['harga' => function ($q) {
                            $q->orderBy('harga_akhir', 'asc');
                        }])
                            ->where('status', 1)
                            ->paginate(10);
                        break;
                    case 3:
                        $produk = Produk::with('stok', 'gambar_produk', 'kategori')->whereHas('kategori', function ($query) use ($kategori) {
                            $query->where('slug', $kategori);
                        })->with(['harga' => function ($q) {
                            $q->orderBy('harga_akhir', 'desc');
                        }])
                            ->where('status', 1)
                            ->paginate(10);
                        break;
                }

                $render = View::make('pages.landing.produk-card', compact('produk'))->render();

                return ResponseFormatter::success($render, 'data berhasil diambil');
            }

            return view('pages.landing.produk-by-kategori', compact('produk', 'kategori_all', 'slug'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function penerbit($penerbit, Request $request)
    {
        try {
            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'penerbit')->whereHas('penerbit', function ($query) use ($penerbit) {
                $query->where('slug', $penerbit);
            })->orderBy('created_at', 'desc')->where('status', 1)->paginate(10);

            $penerbit_all = Penerbit::get();
            $slug = $penerbit_all->where('slug', $penerbit)->first();

            if (!$slug) {
                abort(404);
            }

            if ($request->ajax()) {

                if ($request->filter) {

                    switch ($request->sort) {
                        case 1:
                            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'penerbit', 'ratings')->whereHas('penerbit', function ($query) use ($penerbit) {
                                $query->where('slug', $penerbit);
                            })
                                ->orderBy('created_at', 'desc')
                                ->where('status', 1);
                            // ->paginate(10);
                            break;
                        case 2:
                            $produk = Produk::with('stok', 'gambar_produk', 'penerbit', 'kategori', 'ratings')->whereHas('penerbit', function ($query) use ($penerbit) {
                                $query->where('slug', $penerbit);
                            })->with(['harga' => function ($q) {
                                $q->orderBy('harga_akhir', 'asc');
                            }])->where('status', 1);
                            // ->paginate(10);
                            break;
                        case 3:
                            $produk = Produk::with('stok', 'gambar_produk', 'penerbit', 'kategori', 'ratings')->whereHas('penerbit', function ($query) use ($penerbit) {
                                $query->where('slug', $penerbit);
                            })->with(['harga' => function ($q) {
                                $q->orderBy('harga_akhir', 'desc');
                            }])->where('status', 1);
                            // ->paginate(10);
                            break;
                    }

                    // Get Rentang Harga
                    $harga1 = (int) filter_var($request->slide[0], FILTER_SANITIZE_NUMBER_INT);
                    $harga2 = (int) filter_var($request->slide[1], FILTER_SANITIZE_NUMBER_INT);

                    if ($harga2 > 1000) {
                        $produk->whereHas('harga', function ($q) use ($harga1, $harga2) {
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
                    } else {
                        $produks = $produk_collect;
                    }

                    $render = View::make('pages.landing.produk-card-filter', compact('produks'))->render();

                    return ResponseFormatter::success($render, 'data berhasil diambil');
                }

                switch ($request->sort) {
                    case 1:
                        $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'penerbit')->whereHas('penerbit', function ($query) use ($penerbit) {
                            $query->where('slug', $penerbit);
                        })
                            ->orderBy('created_at', 'desc')
                            ->where('status', 1)
                            ->paginate(10);
                        break;
                    case 2:
                        $produk = Produk::with('stok', 'gambar_produk', 'kategori', 'penerbit')->whereHas('penerbit', function ($query) use ($penerbit) {
                            $query->where('slug', $penerbit);
                        })->with(['harga' => function ($q) {
                            $q->orderBy('harga_akhir', 'asc');
                        }])
                            ->where('status', 1)
                            ->paginate(10);
                        break;
                    case 3:
                        $produk = Produk::with('stok', 'gambar_produk', 'kategori', 'penerbit')->whereHas('penerbit', function ($query) use ($penerbit) {
                            $query->where('slug', $penerbit);
                        })->with(['harga' => function ($q) {
                            $q->orderBy('harga_akhir', 'desc');
                        }])
                            ->where('status', 1)
                            ->paginate(10);
                        break;
                }

                $render = View::make('pages.landing.produk-card', compact('produk'))->render();

                return ResponseFormatter::success($render, 'data berhasil diambil');
            }

            return view('pages.landing.produk-by-penerbit', compact('produk', 'penerbit_all', 'slug'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function detail($id)
    {
        try {
            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'penerbit')
                ->where('id', $id)
                ->where('status', 1)
                ->first();

            $produk_related = Produk::with('harga', 'stok', 'gambar_produk')
                ->where('id_kategori', $produk->id_kategori)
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $rating = Rating::with('produk', 'user')
                ->whereHas('produk', function ($q) use ($id) {
                    $q->where('id', $id);
                })
                ->orderBy('rating');

            $ulasan_perorang = $rating->limit(7)->get();

            $ulasan = $rating->select('rating', DB::raw('count(*) as total'))
                ->groupBy('rating')
                ->get();

            $rate = [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0
            ];

            foreach ($ulasan as $key => $value) {
                $rate[$value->rating] = $value->total;
            }

            // dd($ulasan_perorang); 

            return view('pages.landing.detail', compact('produk', 'produk_related', 'ulasan', 'ulasan_perorang', 'rate'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function detail_blog($id)
    {
        try {
            $b = Blog::where('id', $id)->first();
            if ($b) {
                return view('pages.landing.blog', compact('b'));
            } else {
                abort(404);
            }
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

            $produk = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'ratings')->where('status', 1)->paginate(12);

            foreach ($produk as $key => $value) {
                // Add Persen to Produk
                $hitung = $value->harga->diskon / $value->harga->harga_awal * 100;
                $produk[$key]->persen = floor($hitung);
            }

            $produk = $produk->where('persen', '>=', $popup->diskon);

            return view('pages.landing.produk-by-popup', compact('kategori_all', 'produk'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function search(Request $request)
    {

        $query = $request->get('query');
        $kategori_all = Kategori::get();

        $produk_all = Produk::with('harga', 'stok', 'gambar_produk', 'kategori', 'ratings')
            ->where('nama_produk', 'like', '%' . $query . '%')
            ->where('status', 1);

        if ($request->ajax()) {
            return response()->json($produk_all->get());
        }

        $produk = $produk_all->limit(50)->paginate(2);

        return view('pages.landing.produk-by-search', compact('kategori_all', 'produk', 'query'));
    }

    public function new_produk(Request $request)
    {
        $produk = Produk::with('harga', 'stok', 'gambar_produk')->orderBy('created_at', 'desc')->where('status', 1)->limit(30)->paginate(12);
        $kategori_all = Kategori::get();
        return view('pages.landing.new_produk', compact('kategori_all', 'produk'));
    }

    public function member()
    {
        $member = Member::get();
        return view('pages.landing.member', compact('member'));
    }

    public function blog()
    {
        $blog = Blog::where('status', 1)->paginate(10);
        return view('pages.landing.blog-all', compact('blog'));
    }
}
