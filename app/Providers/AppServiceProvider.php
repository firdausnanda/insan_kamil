<?php

namespace App\Providers;

use App\Models\Keranjang;
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

        view()->composer(['layouts.landing.header'], function($view) {
            $view->with('cart', Keranjang::with('produk')->where('id_user', Auth::user()->id ?? 1)->count());
        });
    }
}
