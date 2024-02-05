<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PopupController extends Controller
{
    public function index(Request $request) 
    {
        
        $p = Popup::first();
        return view('pages.admin.popup.index', compact('p'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'diskon' => 'required',
            'keterangan' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png'
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
                    'public/popup',
                    $request->file('gambar'),
                    $fileName
                );
            }else{
                $fileName = '';
            }

            $data = Popup::where('id', $request->id)->update([
                'judul' => $request->judul,
                'diskon' => $request->diskon,
                'keterangan' => $request->keterangan,
                'gambar' => $fileName,
                'status' => 0
            ]);

            return ResponseFormatter::success($data, 'Data berhasil disimpan');

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

            $update = Popup::where('id', $request->id)->update([
                'status' => $status
            ]);

            return ResponseFormatter::success($update, 'Data berhasil diubah!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }

    }
}
