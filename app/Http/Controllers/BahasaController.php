<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Bahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BahasaController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->ajax()) {
            $bahasa = Bahasa::all();
            return ResponseFormatter::success($bahasa, 'data berhasil diambil!');
        }
        return view('pages.admin.bahasa.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'bahasa' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            
            $bahasa = Bahasa::create([
                'bahasa' => $request->bahasa
            ]);

            return ResponseFormatter::success($bahasa, 'Data berhasil disimpan!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'bahasa' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            
            $bahasa = Bahasa::where('id', $request->id)->update([
                'bahasa' => $request->bahasa
            ]);

            return ResponseFormatter::success($bahasa, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }
}
