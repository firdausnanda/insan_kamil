<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UlasanController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ulasan = Rating::with('produk', 'user')->get();
            return ResponseFormatter::success($ulasan, 'data berhasil diambil!');
        }

        return view('pages.admin.ulasan.index');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'rating' => 'required|string|max:255',
			'comment' => 'required|string',
			'id' => 'required|string',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            $ulasan = Rating::where('id', $request->id)->update([
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);

            return ResponseFormatter::success($ulasan, 'Data berhasil diupdate!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }        
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'id' => 'required|string',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            
            $ulasan = Rating::where('id', $request->id)->delete();
            return ResponseFormatter::success($ulasan, 'Data dihapus!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
