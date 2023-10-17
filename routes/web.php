<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Produk\ProdukController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
  
	// Dashboard
	Route::get('', [DashboardController::class, 'index'])->name('index');

  // Produk
  Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
		Route::get('', [ProdukController::class, 'index'])->name('index');
	});
  
});
