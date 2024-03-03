<?php

namespace App\Http\Controllers\User;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request) 
    {
        $user = User::with('province', 'city', 'district')->where('id', Auth::user()->id)->first();
        return view('pages.user.profil.index', compact('user'));
    }

    public function provinsi() 
    {
        $provinsi = Province::get();
        return ResponseFormatter::success($provinsi, 'Data berhasil diambil!');
    }
    
    public function kota($id) 
    {
        $kota = City::where('province_id', $id)->get();
        return ResponseFormatter::success($kota, 'Data berhasil diambil!');
    }

    public function desa($id) 
    {
        $desa = Subdistrict::where('city_id', $id)->get();
        return ResponseFormatter::success($desa, 'Data berhasil diambil!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'id_user' => 'required|string|max:255',
			'nama' => 'required|string|max:255',
			'no_telepon' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'alamat' => 'required|string|max:255',
			'provinsi' => 'required|string|max:255',
			'kota' => 'required|string|max:255',
			'desa' => 'required|string|max:255',
			'kode_pos' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            
            $user = User::where('id', $request->id_user)->update([
                'name' => $request->nama,
                'no_telp' => $request->no_telepon,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'desa' => $request->desa,
                'kode_pos' => $request->kode_pos,
            ]);

            return ResponseFormatter::success($user, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }   
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'id_user' => 'required|string|max:255',
			'password_baru' => 'required|string|max:255',
			'password_ulangi' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}
        
        try {
            
            if ($request->password_baru != $request->password_ulangi) {
                return ResponseFormatter::error('Password tidak sama', 'Data tidak valid', 422);
            }

            $user = User::where('id', $request->id_user)->update([
                'password' => Hash::make($request->password_baru),
            ]);

            return ResponseFormatter::success($user, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }  

    }

    public function edit(Request $request)
    {
        $user = User::with('province', 'city', 'district', 'member')->where('id', Auth::user()->id)->first();
        return view('pages.user.profil.edit', compact('user'));
    }
}
