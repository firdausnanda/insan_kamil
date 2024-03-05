<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Diskon;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DiskonController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if($request->diskon_id){
                $produk = Produk::with('diskon', 'stok', 'harga', 'kategori')->whereHas('diskon', function($q) use($request){
                    $q->where('id_diskon', $request->diskon_id);
                })->get();

                return ResponseFormatter::success($produk, 'data produk berhasil diambil');
            }

            $data = Diskon::withCount('produk')->get();
            return ResponseFormatter::success($data, 'data berhasil diambil');
        }

        return view('pages.admin.diskon.index');
    }

    public function getProduk(Request $request)
    {
        $produk = Produk::with('diskon', 'stok', 'harga', 'kategori')->whereDoesntHave('diskon', function($q) use($request){
            $q->where('id_diskon', $request->diskon);
        })->where('status', 1)->get();

        return ResponseFormatter::success($produk, 'data berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
			'diskon' => 'required|numeric|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Kategori tidak valid', 422);
		}

        try {
            
            $diskon = Diskon::create([
                'nama' => $request->nama,
                'keterangan' => $request->deskripsi,
                'diskon' => $request->diskon,
                'mulai_diskon' => $request->tanggal_mulai_diskon,
                'selesai_diskon' => $request->tanggal_selesai_diskon,
                'status' => 1
            ]);

            return ResponseFormatter::success($diskon, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
            'diskon' => 'required|numeric|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Kategori tidak valid', 422);
		}

        try {
            
            $diskon = Diskon::where('id', $request->id)->update([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'diskon' => $request->diskon
            ]);

            return ResponseFormatter::success($diskon, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function aktif(Request $request)
    {
        try {

            $diskon = Diskon::where('id', $request->id)->first();

            if ($diskon->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }
            
            $diskon->update([
                'status' => $status
            ]);

            return ResponseFormatter::success($diskon, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function produk_destroy(Request $request)
    {
        try {
            $diskon = Diskon::where('id', $request->id_diskon)->first();
            $diskon->produk()->detach($request->id_produk);
            return ResponseFormatter::success($diskon, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function produk_store(Request $request)
    {
        try {
            $diskon = Diskon::where('id', $request->diskon)->first();
            $diskon->produk()->attach($request->data_produk);
            return ResponseFormatter::success($diskon, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
