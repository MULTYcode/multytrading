<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\dt_routes;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $daftarmenu = dt_routes::orderBy('_order')->get();
        view()->share('daftarmenu', $daftarmenu);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
