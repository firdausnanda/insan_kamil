<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class BackupdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directory = storage_path('app') . '/' . config('app.name');

        if (!file_exists($directory)) {
        return [];
        }

        $backupFiles = \File::allFiles($directory);

        // Sort files by modified time DESC
        usort($backupFiles, function ($a, $b) {
        return -1 * strcmp($a->getMTime(), $b->getMTime());
        });

        return view('pages.admin.backupdb.index', compact('backupFiles'));
    }

    public function databaseDownload($fileName)
    {
        $directory = storage_path('app') . '/' . config('app.name') . '/';

        if (file_exists($directory . $fileName)) {
        $path = $directory . $fileName;
        $downloadFileName = env('APP_ENV') . '.' . $fileName;

        return response()->download($path, $downloadFileName);
        }

        return abort(404);
    }

    public function databaseBackup()
    {
        try {
        Artisan::call('backup:run --only-db');
        return redirect()->back()->with('success', 'Sukses!, Backup database berhasil.');
        } catch (\Exception $e) {
        Log::error($e->getMessage());

        return redirect()->back()->with('error', 'Error! Backup database gagal.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
