<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blog = Blog::get();
            return ResponseFormatter::success($blog, 'data berhasil diambil');
        }
        return view('pages.admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'judul' => 'required|string|max:255',
			'deskripsi' => 'required',
            'gambar' => 'file|mimes:jpg,jpeg,png'
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data Kategori tidak valid', 422);
		}

        try {

            if ($request->hasFile('gambar')) {

                $file = $request->file('gambar');
                $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());
        
                // Store Image
                $path = Storage::putFileAs(
                    'public/blog',
                    $request->file('gambar'),
                    $fileName
                );
            }

            $data = Blog::create([
                'gambar' => $fileName,
                'judul' => $request->judul,
                'isi' => $request->deskripsi,
                'status' => 1
            ]);

            return ResponseFormatter::success($data, 'data berhasil dibuat');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $b = Blog::where('id', $id)->first();
            return view('pages.admin.blog.edit', compact('b'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {

            $blog = Blog::where('id', $request->id)->first();

            if ($request->hasFile('gambar')) {

                // Hapus Gambar lama
                Storage::delete('public/blog' . $blog->gambar);

                $file = $request->file('gambar');
                $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());
        
                // Store Image
                $path = Storage::putFileAs(
                    'public/blog',
                    $request->file('gambar'),
                    $fileName
                );

                // update gambar
                $blog->update([
                    'gambar' => $fileName
                ]);
            }

            $data = $blog->update([
                'judul' => $request->judul,
                'isi' => $request->deskripsi,
            ]);

            return ResponseFormatter::success($data, 'data berhasil diupdate');
            

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

            $data = Blog::where('id', $request->id)->update([
                'status' => $status
            ]);

            return ResponseFormatter::success($data, 'data berhasil diubah');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
