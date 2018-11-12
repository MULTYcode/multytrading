<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Closure;

class cekrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (Auth::user()) {
            //$route = Route::currentRouteName();

            $route = explode('@', Route::getCurrentRoute()->getActionName())[0];
            $route = preg_replace('/[\W\s\/]+/', '.', $route);

            //\Debugbar::info(asset("bower_components/jquery/dist/jquery.min.js"));
            //\Debugbar::info($route);
            //\Debugbar::info(explode('@', Route::getCurrentRoute()->getActionName()))[1];
            //\Debugbar::info(Route::currentRouteName());

            // $akses = DB::connection('mysql')->select("select REPLACE(dt_routes.route,'/','') as route from dt_routes
            //   left join dt_auth on dt_auth.route_id = dt_routes.id
            //  where dt_auth.user_id = " . Auth::user()->id . " and REPLACE(dt_routes.route,'/','') = '" . $route . "'");
            $akses = DB::connection('mysql')->select("select route_action as route from dt_routes
              left join dt_auth on dt_auth.route_id = dt_routes.id
             where dt_auth.user_id = " . Auth::user()->id . " and route_action = '" . $route . "' ");
            foreach ($akses as $rowsakses) {
                if ($rowsakses->route == $route) {
                    return $next($request);
                }
            }
            //return abort(404);
            return redirect()->route('noaccess');
        }
    }
}
