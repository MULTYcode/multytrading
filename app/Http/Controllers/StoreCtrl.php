<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class StoreCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $route = Route::currentRouteName();
        $akses = DB::connection('mysql')->select("select REPLACE(dt_routes.route,'/','') as route from dt_routes
        left join dt_auth on dt_auth.route_id = dt_routes.id
        where dt_auth.user_id = " . Auth::user()->id . " and REPLACE(dt_routes.route,'/','') = '" . $route . "'");
        $sama = "";
        foreach ($akses as $rowsakses) {
            if ($rowsakses->route == $route) {
                return view('store');
                break;
            }
        }
        return view('noaccess');
    }
}
