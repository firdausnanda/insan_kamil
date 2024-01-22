<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SlideshowController extends Controller
{
    public function index(Request $request) 
    {
        
        if ($request->ajax()) {
            $gambar = Slideshow::get();
            return ResponseFormatter::success($gambar, 'Data berhasil diambil!');
        }

        return view('pages.admin.slideshow.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'gambar' => 'required|file|mimes:jpg,jpeg,png,pdf'

        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'Data gagal ditambahkan', 422);
        }

        try {
            
            if ($request->hasFile('gambar')) {

                $file = $request->file('gambar');
                $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());
        
                // Store Image
                $path = Storage::putFileAs(
                    'public/slideshow',
                    $request->file('gambar'),
                    $fileName
                );
            }

            $cek = Slideshow::max('urutan');

            if ($cek == null) {
                $urutan = 1;
            }else{
                $urutan = $cek + 1;
            }

            $data = Slideshow::create([
                'gambar' => $fileName,
                'status' => 1,
                'urutan' => $urutan
            ]);

            return ResponseFormatter::success($data, 'data berhasil dibuat');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function update(Request $request) 
    {
        try {

            $cek = Slideshow::where('id', $request->id_slide)->first();

            if ($request->hasFile('gambar')) {

                // Hapus Gambar lama
                Storage::delete('public/slideshow' . $cek->gambar);

                $file = $request->file('gambar');
                $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());
        
                // Store Image
                $path = Storage::putFileAs(
                    'public/slideshow',
                    $request->file('gambar'),
                    $fileName
                );

                // update gambar
                $cek->update([
                    'gambar' => $fileName
                ]);
            }

            $cek->update([
                'urutan' => $request->urutan,
                'status' => $request->status
            ]);

            return ResponseFormatter::success($cek, 'data berhasil diubah!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
        
    }

    public function aktif(Request $request) 
    {

        try {
            if ($request->status == 1) {
                $status = 0;
            }else{
                $status = 1;
            }

            $update = Slideshow::where('id', $request->id)->update([
                'status' => $status
            ]);

            return ResponseFormatter::success($update, 'Data berhasil diubah!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }

    }
}
