<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenerbitController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            $penerbit = Penerbit::all();
            return ResponseFormatter::success($penerbit, 'data berhasil diambil!');
        }
        return view('pages.admin.penerbit.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Penerbit tidak valid', 422);
		}

        try {
            
            $penerbit = Penerbit::create([
                'nama_penerbit' => $request->nama
            ]);

            return ResponseFormatter::success($penerbit, 'Data berhasil disimpan!');
            
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
            
            $penerbit = Penerbit::where('id', $request->id)->update([
                'nama_penerbit' => $request->nama
            ]);

            return ResponseFormatter::success($penerbit, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }
}
