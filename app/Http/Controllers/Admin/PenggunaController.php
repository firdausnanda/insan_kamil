<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{

    public function index(Request $request)
    {

        $role = Role::all();
        $kota = City::all();

        if ($request->ajax()) {
            $pengguna = User::with('roles')->whereHas('roles', function($query) use($request) {
                $query->where('name', $request->role);
            })->get();
            return ResponseFormatter::success($pengguna, 'Data berhasil diambil!');
        }
        return view('pages.admin.pengguna.index', compact('role', 'kota'));
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama' => 'required|string|max:255',
			'no_telp' => 'required|string|max:255',
			'email' => 'required|string|max:255',
			'alamat' => 'required|string|max:255',
			'provinsi' => 'required|string|max:255',
			'kota' => 'required|string|max:255',
			'password' => 'required|string|max:255',
			'role' => 'required|string|max:255',
		]);

		if ($validator->fails()) {
			return ResponseFormatter::error($validator->errors(), 'Data tidak valid', 422);
		}

        try {
            
            $user = User::create([
                'name' => $request->nama,
                'username' => $request->nama,
                'uuid' => Str::uuid(),
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole($request->role);

            return ResponseFormatter::success($user, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }   
    }

    public function update(Request $request)
    {
        try {

            $update = User::where('id', $request->id_e)->update([
                'name' => $request->nama,
                'username' => $request->nama,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
            ]);

            $user = User::where('id', $request->id_e)->first();

            $user->syncRoles($request->role);

            return ResponseFormatter::success($update, 'Data berhasil diubah!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'password_e' => 'required|string|max:255',
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

            $user = User::where('id', $request->password_e)->update([
                'password' => Hash::make($request->password_baru),
            ]);

            return ResponseFormatter::success($user, 'Data berhasil diubah!');
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error($e->getMessage(), 'Kesalahan Server!');
        }  

    }
}
