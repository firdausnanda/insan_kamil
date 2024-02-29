<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\GroupMenu;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MenuGroupController extends Controller
{
    public function index(Request $request) 
    {
        try {

            if ($request->ajax()) {

                if($request->id_menu){
                    $produk = Produk::with('menu', 'stok', 'harga', 'kategori')->whereHas('menu', function($q) use($request){
                        $q->where('id_group_menu', $request->id_menu);
                    })->get();

                    return ResponseFormatter::success($produk, 'data produk berhasil diambil');
                }

                $menu = GroupMenu::with('produk')->withCount('produk')->get();
                return ResponseFormatter::success($menu, 'data berhasil diambil');
            }
            
            return view('pages.admin.menu_group.index');            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function getProduk(Request $request)
    {
        $produk = Produk::with('menu', 'stok', 'harga', 'kategori')->whereDoesntHave('menu', function($q) use($request){
            $q->where('id_group_menu', $request->id_menu);
        })->where('status', 1)->get();

        return ResponseFormatter::success($produk, 'data berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Kategori tidak valid', 422);
		}

        try {
            
            $menu = GroupMenu::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi
            ]);

            return ResponseFormatter::success($menu, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Kategori tidak valid', 422);
		}

        try {
            
            $menu = GroupMenu::where('id', $request->id)->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi
            ]);

            return ResponseFormatter::success($menu, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function aktif(Request $request)
    {
        try {

            $menu = GroupMenu::where('id', $request->id)->first();

            if ($menu->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }
            
            $menu->update([
                'status' => $status
            ]);

            return ResponseFormatter::success($menu, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function produk_store(Request $request)
    {
        try {
            $menu = GroupMenu::where('id', $request->id_menu)->first();
            $menu->produk()->attach($request->data_produk);
            return ResponseFormatter::success($menu, 'Data berhasil disimpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
    
    public function produk_destroy(Request $request)
    {
        try {
            $menu = GroupMenu::where('id', $request->id_menu)->first();
            $menu->produk()->detach($request->id_produk);
            return ResponseFormatter::success($menu, 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
