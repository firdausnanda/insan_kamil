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
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\UlasanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BahasaController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\MenuGroupController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController;
use App\Models\Blog;
use App\Models\Diskon;
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
Route::get('/promo', [HomeController::class, 'detail_popup'])->name('landing.detail_popup');
Route::get('/member', [HomeController::class, 'member'])->name('landing.member');
Route::get('/blog/{id}', [HomeController::class, 'detail_blog'])->name('landing.detail_blog');
Route::get('/kategori/{kategori}', [HomeController::class, 'kategori'])->name('landing.kategori');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('landing.detail');
Route::get('/new-produk', [HomeController::class, 'new_produk'])->name('landing.new_produk');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/cari', [HomeController::class, 'search'])->name('cari');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

// Auth
Auth::routes();
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin|superadmin|marketing']], function () {
  
	// Dashboard
	Route::get('', [DashboardController::class, 'index'])->name('index');

  // Produk
  Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
		Route::get('', [ProdukController::class, 'index'])->name('index');
		Route::post('', [ProdukController::class, 'store'])->name('store');
		Route::post('/image', [ProdukController::class, 'image'])->name('image');
		Route::get('/create', [ProdukController::class, 'create'])->name('create');
		Route::post('/update', [ProdukController::class, 'update'])->name('update');
		Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');

		// Diskon
		Route::group(['prefix' => 'diskon', 'as' => 'diskon.'], function () {
			Route::get('', [DiskonController::class, 'index'])->name('index');
			Route::post('', [DiskonController::class, 'store'])->name('store');
			Route::put('', [DiskonController::class, 'flash'])->name('flash');		
			Route::put('/flash', [DiskonController::class, 'update'])->name('update');		
			Route::get('/produk', [DiskonController::class, 'getProduk'])->name('getProduk');		
			Route::post('/produk-store', [DiskonController::class, 'produk_store'])->name('produk_store');		
			Route::delete('/produk-destroy', [DiskonController::class, 'produk_destroy'])->name('produk_destroy');		
		});

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

	// Bahasa
  Route::group(['prefix' => 'bahasa', 'as' => 'bahasa.'], function () {
		Route::get('', [BahasaController::class, 'index'])->name('index');
		Route::post('', [BahasaController::class, 'store'])->name('store');
		Route::put('', [BahasaController::class, 'update'])->name('update');
	});

	// Order
  Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
		Route::get('', [OrderController::class, 'index'])->name('index');
		Route::post('', [OrderController::class, 'store'])->name('store');
		Route::get('/waybill', [OrderController::class, 'waybill'])->name('waybill');
		Route::get('/cetak', [UserOrderController::class, 'cetak'])->name('cetak');
		Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
	});

	// Pengguna
  Route::group(['prefix' => 'pengguna', 'as' => 'pengguna.'], function () {
		Route::get('', [PenggunaController::class, 'index'])->name('index');		
		Route::post('', [PenggunaController::class, 'store'])->name('store');		
		Route::put('', [PenggunaController::class, 'update'])->name('update');		
		Route::post('/password', [PenggunaController::class, 'password'])->name('password');		
		Route::get('/provinsi', [ProfileController::class, 'provinsi'])->name('provinsi');
		Route::get('/kota/{id}', [ProfileController::class, 'kota'])->name('kota');
		Route::get('/desa/{id}', [ProfileController::class, 'desa'])->name('desa');
	});

	// Ulasan
  Route::group(['prefix' => 'ulasan', 'as' => 'ulasan.'], function () {
		Route::get('', [UlasanController::class, 'index'])->name('index');		
		Route::put('', [UlasanController::class, 'update'])->name('update');		
		Route::delete('', [UlasanController::class, 'destroy'])->name('destroy');		
	});
	
	// Blog
  Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
		Route::get('', [BlogController::class, 'index'])->name('index');		
		Route::post('', [BlogController::class, 'store'])->name('store');		
		Route::get('/create', [BlogController::class, 'create'])->name('create');
		Route::post('/edit', [BlogController::class, 'update'])->name('update');
		Route::post('/aktif', [BlogController::class, 'aktif'])->name('aktif');
		Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
	});

	// Slideshow
  Route::group(['prefix' => 'slideshow', 'as' => 'slideshow.'], function () {
		Route::get('', [SlideshowController::class, 'index'])->name('index');		
		Route::post('', [SlideshowController::class, 'store'])->name('store');		
		Route::get('/aktif', [SlideshowController::class, 'aktif'])->name('aktif');		
		Route::post('/update', [SlideshowController::class, 'update'])->name('update');		
		Route::post('/image', [SlideshowController::class, 'image'])->name('image');		
	});

	// Popup
  Route::group(['prefix' => 'popup', 'as' => 'popup.'], function () {
		Route::get('', [PopupController::class, 'index'])->name('index');		
		Route::post('', [PopupController::class, 'store'])->name('store');		
		Route::get('/aktif', [PopupController::class, 'aktif'])->name('aktif');		
		Route::post('/update', [PopupController::class, 'update'])->name('update');		
		Route::post('/image', [PopupController::class, 'image'])->name('image');		
	});

	// Menu Group
  Route::group(['prefix' => 'menu', 'as' => 'menu.'], function () {
		Route::get('', [MenuGroupController::class, 'index'])->name('index');		
		Route::post('', [MenuGroupController::class, 'store'])->name('store');		
		Route::put('', [MenuGroupController::class, 'update'])->name('update');		
		Route::get('/produk', [MenuGroupController::class, 'getProduk'])->name('getProduk');		
		Route::post('/produk-store', [MenuGroupController::class, 'produk_store'])->name('produk_store');		
		Route::delete('/produk-destroy', [MenuGroupController::class, 'produk_destroy'])->name('produk_destroy');		
		Route::put('/aktif', [MenuGroupController::class, 'aktif'])->name('aktif');		
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

// User
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['role:user']], function () {

	// Keranjang Belanja
	Route::group(['prefix' => 'keranjang', 'as' => 'keranjang.'], function () {
		Route::get('', [KeranjangController::class, 'index'])->name('index');
		Route::post('', [KeranjangController::class, 'store'])->name('store');
		Route::delete('', [KeranjangController::class, 'destroy'])->name('destroy');
	});
	
	// Order
	Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
		Route::get('', [UserOrderController::class, 'index'])->name('index');
		Route::post('', [UserOrderController::class, 'store'])->name('store');
		Route::put('/catatan', [UserOrderController::class, 'catatan'])->name('catatan');
		Route::post('/detail-store', [UserOrderController::class, 'detail_store'])->name('detail_store');
		Route::post('/beli', [UserOrderController::class, 'beli'])->name('beli');
		Route::post('/pembayaran', [UserOrderController::class, 'pembayaran'])->name('pembayaran');
		Route::get('/ongkir', [UserOrderController::class, 'ongkir'])->name('ongkir');
		Route::get('/jumlah', [UserOrderController::class, 'jumlah'])->name('jumlah');
		Route::post('/temp', [UserOrderController::class, 'temp'])->name('temp');
		Route::get('/konfirmasi', [UserOrderController::class, 'konfirmasi'])->name('konfirmasi');
		Route::get('/waybill', [UserOrderController::class, 'waybill'])->name('waybill');
		Route::get('/diterima', [UserOrderController::class, 'diterima'])->name('diterima');
		Route::post('/rating', [UserOrderController::class, 'rating'])->name('rating');
		Route::get('/dropship', [UserOrderController::class, 'dropship'])->name('dropship');
		Route::put('/dropship', [UserOrderController::class, 'edit_dropship'])->name('edit_dropship');
		Route::get('/cetak', [UserOrderController::class, 'cetak'])->name('cetak');
		Route::get('/detail-konfirmasi/{id}', [UserOrderController::class, 'detail_konfirmasi'])->name('detail_konfirmasi');
	});

	// Profile
	Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
		Route::get('', [ProfileController::class, 'edit'])->name('edit');
		Route::post('', [ProfileController::class, 'store'])->name('store');
		Route::get('/edit', [ProfileController::class, 'index'])->name('index');
		Route::post('/password', [ProfileController::class, 'password'])->name('password');
		Route::get('/provinsi', [ProfileController::class, 'provinsi'])->name('provinsi');
		Route::get('/kota/{id}', [ProfileController::class, 'kota'])->name('kota');
		Route::get('/desa/{id}', [ProfileController::class, 'desa'])->name('desa');
	});

});

// Midtrans
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
Route::get('payments/error', [PaymentCallbackController::class, 'error']);
