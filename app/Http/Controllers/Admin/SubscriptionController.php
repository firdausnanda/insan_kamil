<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionNo;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = SubscriptionNo::all();
            return ResponseFormatter::success($data, 'Data berhasil diambil');
        }
        return view('pages.admin.subscription.index');
    }

    public function update(Request $request)
    {
        $data = SubscriptionNo::find($request->id);
        $data->update($request->all());
        return ResponseFormatter::success($data, 'Data berhasil diubah');
    }

    public function destroy(Request $request)
    {
        $data = SubscriptionNo::find($request->id);
        $data->delete();
        return ResponseFormatter::success($data, 'Data berhasil dihapus');
    }
}
