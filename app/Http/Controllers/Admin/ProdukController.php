<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\GambarProduk;
use App\Models\Harga;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index(Request $request) 
    {
        $kategori = Kategori::all();
        if ($request->ajax()) {
            $produk = Produk::with('kategori', 'harga')->whereHas('kategori', function($query) use($request) {
                $query->where('id', $request->kategori);
            })->get();
            return ResponseFormatter::success($produk, 'Data berhasil diambil');
        }
        return view('pages.admin.produk.index', compact('kategori'));
    }
   
    public function create() 
    {
        $kategori = Kategori::all();
        $penerbit = Penerbit::all();
        return view('pages.admin.produk.create', compact('kategori', 'penerbit'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
			'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'berat' => 'required|numeric',
			'panjang' => 'numeric|max:255',
			'lebar' => 'numeric|max:255',
            'penerbit' => 'string|max:255',
            'bahasa' => 'string|max:255',
            'isbn' => 'string|max:255',
            'jenis_cover' => 'string|max:255',
            'jumlah_halaman' => 'string|max:255',
            'instok' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'harga_normal_clean' => 'required|string|max:255',
            'harga_promo_clean' => 'nullable|max:255',
            'pengarang' => 'string',
            'deskripsi' => 'required|string',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Produk tidak valid', 422);
		}

        try {

            // Hitung Diskon
            if ($request->harga_promo_clean == 0) {
                $diskon = 0;
            }else{
                $diskon = ($request->harga_normal_clean - $request->harga_promo_clean) / 100 * 100;
            }

            // Create on Harga
            $harga = Harga::create([
                'harga_awal' => $request->harga_normal_clean,
                'diskon' => $diskon,
                'harga_akhir' => $request->harga_normal_clean,
            ]);

            // Create on Stok
            $stok = Stok::create([
                'jumlah_produk' => $request->stok,
                'sisa_produk' => $request->stok,
            ]);

            // Create on Produk
            $produk = Produk::create([
                'id_kategori' => $request->kategori,
                'id_penerbit' => $request->penerbit,
                'id_harga' => $harga->id,
                'id_stok' => $stok->id,
                'kode_produk' => $request->kode_produk,
                'nama_produk' => $request->judul,
                'berat_produk' => $request->berat,
                'ukuran_produk' => $request->panjang . 'x' . $request->lebar,
                'bahasa' => $request->bahasa,
                'isbn' => $request->isbn,
                'jenis_cover' => $request->jenis_cover,
                'halaman_produk' => $request->jumlah_halaman,
                'keterangan' => $request->deskripsi,
                'status' => $request->status,
                'pengarang' => $request->pengarang,
            ]);

            // Create on Gambar
            foreach ($request->document as $d) {
                $gambar = GambarProduk::create([
                    'id_produk' => $produk->id,
                    'gambar' => $d,
                ]);
            }

            return ResponseFormatter::success($produk, 'Data berhasil disimpan!', 200);
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);        
        }        
    }
    
    public function image(Request $request) 
    {
        
        $file = $request->file('file');
        $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());

        // Store Image
        $path = Storage::putFileAs(
            'public/produk',
            $request->file('file'),
            $fileName
        );

        return response()->json([
            'name'          => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function edit($id) 
    {
        try {
            $kategori = Kategori::all();
            $penerbit = Penerbit::all();
            $produk = Produk::with('stok')->where('id', $id)->first();
            // dd($produk);
            // string
            $string = Str::replace('x', ',', $produk->ukuran_produk);
            $ukuran = Str::of($string)->split('/[\s,]+/');

            return view('pages.admin.produk.edit', compact('kategori', 'penerbit', 'produk', 'ukuran'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);        
        }
    }

    public function update() 
    {
     return ResponseFormatter::success('Sukses', 'Data berhasil diubah');   
    }
}
