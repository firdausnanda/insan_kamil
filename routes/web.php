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
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UlasanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BahasaController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\MenuGroupController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\PetunjukController;
use App\Http\Controllers\PointController;
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
Route::get('/penerbit/{penerbit}', [HomeController::class, 'penerbit'])->name('landing.penerbit');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('landing.detail');
Route::get('/new-produk', [HomeController::class, 'new_produk'])->name('landing.new_produk');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/cari', [HomeController::class, 'search'])->name('cari');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::post('/subscription', [HomeController::class, 'subscription'])->name('subscription.store');

// Auth
Auth::routes();
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

	// Login On User
	Route::get('/{user}/impersonate', [ImpersonateController::class, 'impersonate'])->name('impersonate');
	Route::get('/leave-impersonate', [ImpersonateController::class, 'leaveImpersonate'])->name('leave-impersonate');

	// Admin
	Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin|superadmin|marketing']], function () {
		
		// Dashboard
		Route::get('', [DashboardController::class, 'index'])->name('index');

		// Produk
		Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
			Route::get('', [ProdukController::class, 'index'])->name('index');
			Route::post('', [ProdukController::class, 'store'])->name('store');
			Route::post('/image', [ProdukController::class, 'image'])->name('image');
			Route::post('/konfirmasi', [ProdukController::class, 'konfirmasi'])->name('konfirmasi');
			Route::post('/delete', [ProdukController::class, 'removeImage'])->name('removeImage');
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
			Route::post('/edit', [PenerbitController::class, 'update'])->name('update');
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
			Route::get('/cetak/pengiriman', [UserOrderController::class, 'cetak_pengiriman'])->name('cetak_pengiriman');
			Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
		});

		// Pengguna
		Route::group(['prefix' => 'pengguna', 'as' => 'pengguna.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [PenggunaController::class, 'index'])->name('index');		
			Route::post('', [PenggunaController::class, 'store'])->name('store');		
			Route::put('', [PenggunaController::class, 'update'])->name('update');		
			Route::post('/password', [PenggunaController::class, 'password'])->name('password');		
			Route::get('/provinsi', [ProfileController::class, 'provinsi'])->name('provinsi');
			Route::get('/kota/{id}', [ProfileController::class, 'kota'])->name('kota');
			Route::get('/desa/{id}', [ProfileController::class, 'desa'])->name('desa');
		});

		// Ulasan
		Route::group(['prefix' => 'ulasan', 'as' => 'ulasan.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [UlasanController::class, 'index'])->name('index');		
			Route::put('', [UlasanController::class, 'update'])->name('update');		
			Route::delete('', [UlasanController::class, 'destroy'])->name('destroy');		
		});
		
		// Blog
		Route::group(['prefix' => 'blog', 'as' => 'blog.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [BlogController::class, 'index'])->name('index');		
			Route::post('', [BlogController::class, 'store'])->name('store');		
			Route::get('/create', [BlogController::class, 'create'])->name('create');
			Route::post('/edit', [BlogController::class, 'update'])->name('update');
			Route::post('/aktif', [BlogController::class, 'aktif'])->name('aktif');
			Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
		});

		// Slideshow
		Route::group(['prefix' => 'slideshow', 'as' => 'slideshow.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [SlideshowController::class, 'index'])->name('index');		
			Route::post('', [SlideshowController::class, 'store'])->name('store');		
			Route::get('/aktif', [SlideshowController::class, 'aktif'])->name('aktif');		
			Route::post('/update', [SlideshowController::class, 'update'])->name('update');		
			Route::post('/image', [SlideshowController::class, 'image'])->name('image');		
		});

		// Reward
		Route::group(['prefix' => 'reward', 'as' => 'reward.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [RewardController::class, 'index'])->name('index');		
			Route::post('', [RewardController::class, 'store'])->name('store');		
			Route::get('/master', [RewardController::class, 'master'])->name('master');		
			Route::get('/aktif', [RewardController::class, 'aktif'])->name('aktif');		
			Route::post('/update', [RewardController::class, 'update'])->name('update');		
			Route::post('/approve', [RewardController::class, 'approve'])->name('approve');	
			Route::post('/reject', [RewardController::class, 'reject'])->name('reject');	
		});

		// Subscription
		Route::group(['prefix' => 'subscription', 'as' => 'subscription.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [SubscriptionController::class, 'index'])->name('index');		
			Route::post('', [SubscriptionController::class, 'store'])->name('store');		
			Route::put('', [SubscriptionController::class, 'update'])->name('update');		
			Route::delete('', [SubscriptionController::class, 'destroy'])->name('destroy');		
			Route::post('/kirim-pesan', [SubscriptionController::class, 'kirim_pesan'])->name('kirim_pesan');		
		});

		// Popup
		Route::group(['prefix' => 'popup', 'as' => 'popup.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [PopupController::class, 'index'])->name('index');		
			Route::post('', [PopupController::class, 'store'])->name('store');		
			Route::get('/aktif', [PopupController::class, 'aktif'])->name('aktif');		
			Route::post('/update', [PopupController::class, 'update'])->name('update');		
			Route::post('/image', [PopupController::class, 'image'])->name('image');		
		});

		// Menu Group
		Route::group(['prefix' => 'menu', 'as' => 'menu.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [MenuGroupController::class, 'index'])->name('index');		
			Route::post('', [MenuGroupController::class, 'store'])->name('store');		
			Route::put('', [MenuGroupController::class, 'update'])->name('update');		
			Route::get('/produk', [MenuGroupController::class, 'getProduk'])->name('getProduk');		
			Route::post('/produk-store', [MenuGroupController::class, 'produk_store'])->name('produk_store');		
			Route::delete('/produk-destroy', [MenuGroupController::class, 'produk_destroy'])->name('produk_destroy');		
			Route::put('/aktif', [MenuGroupController::class, 'aktif'])->name('aktif');		
			Route::put('/rentang', [MenuGroupController::class, 'rentang'])->name('rentang');		
			Route::put('/preorder', [MenuGroupController::class, 'preorder'])->name('preorder');		
		});
		
		// Activity
		Route::group(['prefix' => 'activity', 'as' => 'activity.', 'middleware' => ['role:admin|superadmin']], function () {
			Route::get('', [ActivityController::class, 'index'])->name('index');		
		});

		// Backup Database
		Route::group(['prefix' => 'backupdb', 'as' => 'backupdb.', 'middleware' => ['role:admin|superadmin']], function () {
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
			Route::get('/subtotal', [KeranjangController::class, 'subtotal'])->name('subtotal');
			Route::post('', [KeranjangController::class, 'store'])->name('store');
			Route::delete('', [KeranjangController::class, 'destroy'])->name('destroy');
		});
		
		// Order
		Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
			Route::get('', [UserOrderController::class, 'index'])->name('index');
			// Route::post('', [UserOrderController::class, 'store'])->name('store');
			Route::post('/alamat', [UserOrderController::class, 'store_alamat'])->name('store_alamat');
			Route::post('/pembayaran-manual', [UserOrderController::class, 'store_manual'])->name('store_manual');
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
			Route::get('/cetak/pengiriman', [UserOrderController::class, 'cetak_pengiriman'])->name('cetak_pengiriman');
			Route::post('/bukti-transaksi', [UserOrderController::class, 'addBukti'])->name('addBukti');
			Route::post('/upload-bukti-transaksi', [UserOrderController::class, 'uploadBukti'])->name('uploadBukti');
			Route::post('/delete-alamat-user', [UserOrderController::class, 'delete_alamat'])->name('delete_alamat');
			Route::put('/ubah-rekening', [UserOrderController::class, 'ubah_rekening'])->name('ubah_rekening');
			Route::get('/aftercheckout/{id}', [UserOrderController::class, 'detail_checkout'])->name('detail_checkout');
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

		// Point
		Route::group(['prefix' => 'point', 'as' => 'point.'], function () {
			Route::get('', [PointController::class, 'index'])->name('index');
			Route::group(['prefix' => 'redeem', 'as' => 'redeem.'], function () {
				Route::get('', [PointController::class, 'redeem'])->name('index');
				Route::post('', [PointController::class, 'redeem_store'])->name('store');
			});
			Route::get('/history', [PointController::class, 'history'])->name('history');
		});

		// Petunjuk Penggunaan
		Route::group(['prefix' => 'petunjuk', 'as' => 'petunjuk.'], function () {
			Route::get('', [PetunjukController::class, 'index'])->name('index');
		});

	});
});


// Midtrans
Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
Route::get('payments/error', [PaymentCallbackController::class, 'error']);
