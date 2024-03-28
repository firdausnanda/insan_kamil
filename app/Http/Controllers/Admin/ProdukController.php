<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Models\Diskon;
use App\Models\GambarProduk;
use App\Models\Harga;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Member;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\Penerbit;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\TempOrder;
use App\Models\User;
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
            $produk = Produk::with('kategori', 'harga', 'stok')->whereHas('kategori', function($query) use($request) {
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
        $bahasa = Bahasa::all();
        return view('pages.admin.produk.create', compact('kategori', 'penerbit', 'bahasa'));
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
			'judul' => 'required|string|max:255',
            'kategori' => 'required',
            'berat' => 'required|numeric',
			'panjang' => 'numeric|max:255',
			'lebar' => 'numeric|max:255',
            'penerbit' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:255',
            'isbn' => 'nullable|string|max:255',
            'jenis_cover' => 'nullable|string|max:255',
            'jumlah_halaman' => 'nullable|string|max:255',
            'instok' => 'required|string|max:255',
            'kode_produk' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'harga_normal_clean' => 'required|string|max:255',
            'harga_promo_clean' => 'nullable|max:255',
            'pengarang' => 'nullable|string',
            'catatan' => 'nullable|string',
            'jenis_isi' => 'nullable|string',
            'deskripsi' => 'required|string',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Produk tidak valid', 422);
		}

        try {

            // Hitung Diskon dan tanggal mulai diskon
            if ($request->harga_promo_clean == 0 || $request->tanggal_mulai_diskon > now()) {
                $promo = $request->harga_normal_clean;
                $diskon = $request->harga_promo_clean ? $request->harga_normal_clean - $request->harga_promo_clean : 0;
                $persentase = $diskon > 0 ? $diskon / $request->harga_normal_clean * 100 : 0; 
            }else{
                $promo = $request->harga_promo_clean;
                $diskon = $request->harga_normal_clean - $request->harga_promo_clean;
                $persentase = $diskon / $request->harga_normal_clean * 100; 
            }

            // Create on Harga
            $harga = Harga::create([
                'harga_awal' => $request->harga_normal_clean,
                'diskon' => $diskon,
                'harga_akhir' => $promo,
                'persentase_diskon' => $persentase,
                'mulai_diskon' => $request->tanggal_mulai_diskon,
                'selesai_diskon' => $request->tanggal_selesai_diskon
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
                'id_bahasa' => $request->bahasa,
                'kode_produk' => $request->kode_produk,
                'nama_produk' => $request->judul,
                'berat_produk' => $request->berat,
                'ukuran_produk' => $request->panjang . 'x' . $request->lebar,
                'isbn' => $request->isbn,
                'jenis_cover' => $request->jenis_cover,
                'halaman_produk' => $request->jumlah_halaman,
                'keterangan' => $request->deskripsi,
                'status' => $request->status,
                'pengarang' => $request->pengarang,
                'catatan' => $request->catatan,
                'jenis_isi' => $request->jenis_isi,
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

    public function addImage(Request $request) 
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

    public function removeImage(Request $request) 
    {
        // var_dump($request->all());
        // dd(asset('storage/produk/' . $request->name));
        // delete Image
        $path = Storage::delete('public/produk/' . $request->name);

        return ResponseFormatter::success($path, 'sukses');
    }

    public function edit(Request $request, $id) 
    {
        try {
            $kategori = Kategori::all();
            $penerbit = Penerbit::all();
            $bahasa = Bahasa::all();
            $produk = Produk::with('stok', 'harga', 'gambar_produk')->where('id', $id)->first();
            // dd($produk);
            // string
            $string = Str::replace('x', ',', $produk->ukuran_produk);
            $ukuran = Str::of($string)->split('/[\s,]+/');

            if ($request->ajax()) {
                return ResponseFormatter::success($produk->gambar_produk, 'Data diambil');
            }

            return view('pages.admin.produk.edit', compact('kategori', 'penerbit', 'produk', 'ukuran', 'bahasa'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);        
        }
    }

    public function update(Request $request) 
    {

        try {
            // Create on Produk
            $produk = Produk::where('id', $request->id)->first();
            $produk->update([
                'id_kategori' => $request->kategori,
                'id_penerbit' => $request->penerbit,
                'id_bahasa' => $request->bahasa,
                'nama_produk' => $request->judul,
                'berat_produk' => $request->berat,
                'ukuran_produk' => $request->panjang . 'x' . $request->lebar,
                'isbn' => $request->isbn,
                'jenis_cover' => $request->jenis_cover,
                'halaman_produk' => $request->jumlah_halaman,
                'keterangan' => $request->deskripsi,
                'status' => $request->status,
                'pengarang' => $request->pengarang,
                'catatan' => $request->catatan,
                'jenis_isi' => $request->jenis_isi,
            ]);

            // Hitung Diskon dan tanggal mulai diskon
            if ($request->harga_promo_clean == 0 || $request->tanggal_mulai_diskon > now()) {
                $diskon = 0;
                $promo = $request->harga_normal_clean;
                $persentase = $diskon > 0 ? $diskon / $request->harga_normal_clean * 100 : 0; 
            }else{
                $promo = $request->harga_promo_clean;
                $diskon = $request->harga_normal_clean - $request->harga_promo_clean;
                $persentase = $diskon / $request->harga_normal_clean * 100;
            }

            // Update / Hapus produk di Event Produk
            $harga = Harga::where('id', $produk->id_harga)->first();

            if ($request->harga_normal_clean != $harga->harga_awal || $diskon != $harga->diskon || $promo != $harga->harga_akhir) {
                $produk->diskon()->detach(Diskon::all());
            }

            $harga->update([
                'harga_awal' => $request->harga_normal_clean,
                'diskon' => $diskon,
                'harga_akhir' => $promo,
                'persentase_diskon' => $persentase,
                'mulai_diskon' => $request->tanggal_mulai_diskon,
                'selesai_diskon' => $request->tanggal_selesai_diskon
            ]);

            // Create on Stok
            $stok = Stok::where('id', $produk->id_stok)->first();
            $stok->update([
                'jumlah_produk' => $request->stok,
                'sisa_produk' => $request->stok
            ]);

            return ResponseFormatter::success($stok, 'Data berhasil diubah');   
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }
    }

    public function konfirmasi(Request $request)
    {
        try {

            // Update Pembayaran
            $pembayaran = Pembayaran::where('id_order', $request->id_order)->first();
                
            $pembayaran->update([
                'status_pembayaran' => 2,
            ]);
            
            // Cek Order
            $order = Order::with('produk_dikirim')->where('id', $request->id_order)->first();
            
            // Update Member
            $user = User::with('member')->where('id', $order->id_user)->first();
            
            // Update pada table Order status & Member yang lama
            $order->update([
                'status' => 2,
                'id_member' => $user->id_member,
            ]);

            // Cek apakah sudah menjadi member apa belum
            if ($user->id_member) {
                $cekmember = Member::where('pembelian_minimum', '>', $user->member->pembelian_minimum)->orderBy('pembelian_minimum', 'desc')->get();
            }else{
                $cekmember = Member::orderBy('pembelian_minimum', 'desc')->get();   
            }

            // Cek total pembelian keseluruhan
            $cek_pembayaran_total = Order::where('id_user', $order->id_user)->wherehas('pembayaran', function($query){
                $query->where('status_pembayaran', 2); 
             })->withSum('pembayaran', 'harga_jual')->get();

            $pembayaran_total = $cek_pembayaran_total->sum('pembayaran_sum_harga_jual');

            if($cekmember->count() > 0){
                 foreach ($cekmember as $v) {

                     // Check if pembelian lebih besar dari pembelian mininum member 
                     if ($pembayaran_total >= $v->pembelian_minimum) {

                         $user->update([
                             'id_member' => $v->id
                         ]);

                         break;
                     }
                 }
            }

            // Remove Keranjang dan TempOrder
            $temp = TempOrder::where('id_user', $order->id_user)->get();
                
            foreach ($temp as $v) {
                Keranjang::where('id_produk', $v->id_produk)->where('id_user', $order->id_user)->delete();
            } 

            TempOrder::where('id_user', $order->id_user)->delete();

            // Stok dikurangi
            foreach ($order->produk_dikirim as $key => $value) {

                // Stok Dikurangi
                $cekProduk = Produk::where('id', $value->id_produk)->first();
                Stok::where('id', $cekProduk->id_stok)->update([
                    'sisa_produk' => $cekProduk->stok->sisa_produk - $value->jumlah_produk
                ]);
            }

            // $order = Order::where('id', $request->id_order)->update([
            //     'status' => 2
            // ]);

            // $pembayaran = Pembayaran::where('id_order', $request->id_order)->update([
            //     'status_pembayaran' => 2
            // ]);

            return ResponseFormatter::success('Sukses', 'Data berhasil dikonfirmasi');   

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error('Error!', $e->getMessage(), 500);
        }
        
    }
}
