<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\RewardPoint;
use App\Models\RiwayatReedem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RewardController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $reward = RiwayatReedem::with('user', 'reward')->get();
            return ResponseFormatter::success($reward, 'Data Reward Point');
        }

        return view('pages.admin.reward.index');
    }

    public function master()
    {
        if (request()->ajax()) {
            $reward = RewardPoint::all();
            return ResponseFormatter::success($reward, 'Data Reward Point');
        }

        return view('pages.admin.reward.master');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'point' => 'required',
            'kuota' => 'required',
            'deskripsi' => 'required',
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
                    'public/reward',
                    $request->file('gambar'),
                    $fileName
                );
            }

            $data = RewardPoint::create([
                'gambar' => $fileName,
                'nama' => $request->nama,
                'point_total' => $request->point,
                'kuota' => $request->kuota,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->status
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

            $cek = RewardPoint::where('id', $request->id_reward)->first();

            if ($request->hasFile('gambar')) {

                // Hapus Gambar lama
                Storage::delete('public/reward' . $cek->gambar);

                $file = $request->file('gambar');
                $fileName =  uniqid() . '_' . time() . '.' . trim($file->getClientOriginalExtension());

                // Store Image
                $path = Storage::putFileAs(
                    'public/reward',
                    $request->file('gambar'),
                    $fileName
                );

                // update gambar
                $cek->update([
                    'gambar' => $fileName
                ]);
            }

            $cek->update([
                'nama' => $request->nama,
                'point_total' => $request->point,
                'deskripsi' => $request->deskripsi,
                'kuota' => $request->kuota,
                'is_active' => $request->status
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

            $cek = RewardPoint::where('id', $request->id)->first();
            $cek->update([
                'is_active' => $status
            ]);

            return ResponseFormatter::success($cek, 'Data berhasil diubah!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'Data gagal disetujui', 422);
        }

        try {

            $cek = RiwayatReedem::where('id', $request->id)->first();
            $cek->update([
                'status' => 'success'
            ]);

            return ResponseFormatter::success($cek, 'Data berhasil disetujui!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function reject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'Data gagal ditolak', 422);
        }

        try {

            $cek = RiwayatReedem::where('id', $request->id)->first();
            $cek->update([
                'status' => 'failed'
            ]);

            return ResponseFormatter::success($cek, 'Data berhasil ditolak!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }
}
