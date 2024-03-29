<?php

namespace App\Providers;

use App\Models\Keranjang;
use App\Models\Order;
use App\Models\Popup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // total keranjang
        view()->composer(['layouts.landing.header'], function($view) {
            $view->with('cart', Keranjang::with('produk')->where('id_user', Auth::user()->id ?? 1)->count());
        });

        // Popup
        view()->composer(['layouts.landing.main'], function($view) {
            $view->with('popup', Popup::first());
        });

        // notif admin
        $order = Order::with('user.member')->where('status', 1)->has('bukti_transaksi')->orWhere('status', 2)->orderBy('updated_at', 'desc');
        $total_notif = $order->count();
        $order_show = $order->limit(5)->get();

        view()->composer(['layouts.dashboard.header'], function($view) use ($total_notif, $order_show) {
            $view->with('total_notif', $total_notif)->with('order_show', $order_show);
        });
    }
}
