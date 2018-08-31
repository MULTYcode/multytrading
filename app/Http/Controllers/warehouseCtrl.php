<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class warehouseCtrl extends Controller
{
    public function index()
    {
        $route = Route::currentRouteName();
        $akses = DB::connection('mysql')->select("select REPLACE(dt_routes.route,'/','') as route from dt_routes
        left join dt_auth on dt_auth.route_id = dt_routes.id
        where dt_auth.user_id = " . Auth::user()->id . " and REPLACE(dt_routes.route,'/','') = '" . $route . "'");
        $sama = "";
        foreach ($akses as $rowsakses) {
            if ($rowsakses->route == $route) {
                return view('warehouse');
                break;
            }
        }
        return view('noaccess');
    }

    public function mutasiperiodeview(Request $request)
    {
        $sqlstr = "select * from w_mutasi
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
        if ($request->storefrom == "" and $request->storeto == "") {
            $res = DB::connection('mysql')->select($sqlstr);
        } elseif ($request->storefrom !== "" and $request->storeto == "") {
            $res = DB::connection('mysql')->select($sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%')");
        } elseif ($request->storefrom == "" and $request->storeto !== "") {
            $res = DB::connection('mysql')->select($sqlstr . " and tujuan like CONCAT('%" . $request->storeto . "%')");
        } else {
            $res = DB::connection('mysql')->select($sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%') and tujuan like CONCAT('%" . $request->storeto . "%')");
        }

        $total = 0;
        $totalpcs = 0;
        foreach ($res as $restotal) {
            $total = $total + $restotal->totaljual;
            $totalpcs = $totalpcs + $restotal->totalkirim;
        }

        //return $res;
        return view('mutasiperiodeview', ['res' => $res, 'total' => $total, 'totalpcs' => $totalpcs]);
    }

}
