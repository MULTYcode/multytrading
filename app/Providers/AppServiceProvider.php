<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\dt_routes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $daftarmenu = DB::connection('mysql')->select("select * from dt_routes 
                                                            join dt_auth on dt_auth.route_id = dt_routes.id
                                                            where dt_auth.user_id = " . Auth::id() . " order by _order");
                view()->share('daftarmenu', $daftarmenu);
            }
        });
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
