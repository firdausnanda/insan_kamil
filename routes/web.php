<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\BackupdbController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PenerbitController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\UlasanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Landing\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('landing.home');
Route::get('/detail', [HomeController::class, 'detail'])->name('landing.detail');

// Auth
Auth::routes();
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  
	// Dashboard
	Route::get('', [DashboardController::class, 'index'])->name('index');

  // Produk
  Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
		Route::get('', [ProdukController::class, 'index'])->name('index');
		Route::post('', [ProdukController::class, 'store'])->name('store');
		Route::post('/image', [ProdukController::class, 'image'])->name('image');
		Route::get('/create', [ProdukController::class, 'create'])->name('create');
	});
  
	// Kategori
  Route::group(['prefix' => 'kategori', 'as' => 'kategori.'], function () {
		Route::get('', [KategoriController::class, 'index'])->name('index');
		Route::post('', [KategoriController::class, 'store'])->name('store');
		Route::put('', [KategoriController::class, 'update'])->name('update');
	});

	// Penerbit
  Route::group(['prefix' => 'penerbit', 'as' => 'penerbit.'], function () {
		Route::get('', [PenerbitController::class, 'index'])->name('index');
		Route::post('', [PenerbitController::class, 'store'])->name('store');
		Route::put('', [PenerbitController::class, 'update'])->name('update');
	});

	// Order
  Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
		Route::get('', [OrderController::class, 'index'])->name('index');
		Route::get('/detail', [OrderController::class, 'detail'])->name('detail');
		
	});

	// Customer
  Route::group(['prefix' => 'pengguna', 'as' => 'pengguna.'], function () {
		Route::get('', [PenggunaController::class, 'index'])->name('index');		
	});

	// Ulasan
  Route::group(['prefix' => 'ulasan', 'as' => 'ulasan.'], function () {
		Route::get('', [UlasanController::class, 'index'])->name('index');		
	});
	
	// Blog
  Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
		Route::get('', [BlogController::class, 'index'])->name('index');		
	});
	
	// Activity
  Route::group(['prefix' => 'activity', 'as' => 'activity.'], function () {
		Route::get('', [ActivityController::class, 'index'])->name('index');		
	});

	// Backup Database
  Route::group(['prefix' => 'backupdb', 'as' => 'backupdb.'], function () {
		Route::get('', [BackupdbController::class, 'index'])->name('index');	
		Route::get('/backup', [BackupdbController::class, 'databaseBackup'])->name('backup');
		Route::get('/download/{fileName}', [BackupdbController::class, 'databaseDownload'])->name('download');

	});  
});
