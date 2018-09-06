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
        if ($request->rekap == 1) {

            if($request->tgl == 1){
                $sqlstr = "select kode,nama,brand,class,warna,ukuran,asal,tujuan,sum(totaljual) as tjual,sum(totalkirim) as tqty from w_mutasi
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";    
            }else{
                $sqlstr = "select kode,nama,brand,class,warna,ukuran,asal,tujuan,sum(totaljual) as tjual,sum(totalkirim) as tqty from w_mutasi
                where tanggal is not null";    
            }

            if ($request->storefrom == "" and $request->storeto == "") {
                $res = $sqlstr;
            } elseif ($request->storefrom !== "" and $request->storeto == "") {
                $res = $sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%') ";
            } elseif ($request->storefrom == "" and $request->storeto !== "") {
                $res = $sqlstr . " and tujuan like CONCAT('%" . $request->storeto . "%') ";
            } else {
                $res = $sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%') and tujuan like CONCAT('%" . $request->storeto . "%') ";
            }

            if ($request->item !== "") {
                $data = DB::connection('mysql')->select($res . " and nama like CONCAT('%" . $request->item . "%') group by kode,nama,brand,class,warna,ukuran,asal,tujuan");
            } else {
                $data = DB::connection('mysql')->select($res . " group by kode,nama,brand,class,warna,ukuran,asal,tujuan");
            }

            $total = 0;
            $totalpcs = 0;
            foreach ($data as $restotal) {
                $total = $total + $restotal->tjual;
                $totalpcs = $totalpcs + $restotal->tqty;
            }

        } else {

            if($request->tgl == 1){
                $sqlstr = "select * from w_mutasi
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";    
            }else{
                $sqlstr = "select * from w_mutasi where tanggal is not null";    
            }

            if ($request->storefrom == "" and $request->storeto == "") {
                $data = DB::connection('mysql')->select($sqlstr);
            } elseif ($request->storefrom !== "" and $request->storeto == "") {
                $data = DB::connection('mysql')->select($sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%')");
            } elseif ($request->storefrom == "" and $request->storeto !== "") {
                $data = DB::connection('mysql')->select($sqlstr . " and tujuan like CONCAT('%" . $request->storeto . "%')");
            } else {
                $data = DB::connection('mysql')->select($sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%') and tujuan like CONCAT('%" . $request->storeto . "%')");
            }

            if ($request->storefrom == "" and $request->storeto == "") {
                $res = $sqlstr;
            } elseif ($request->storefrom !== "" and $request->storeto == "") {
                $res = $sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%') ";
            } elseif ($request->storefrom == "" and $request->storeto !== "") {
                $res = $sqlstr . " and tujuan like CONCAT('%" . $request->storeto . "%') ";
            } else {
                $res = $sqlstr . " and asal like CONCAT('%" . $request->storefrom . "%') and tujuan like CONCAT('%" . $request->storeto . "%') ";
            }

            if ($request->item !== "") {
                $data = DB::connection('mysql')->select($res . " and nama like CONCAT('%" . $request->item . "%')");
            }
            
            $total = 0;
            $totalpcs = 0;
            foreach ($data as $restotal) {
                $total = $total + $restotal->totaljual;
                $totalpcs = $totalpcs + $restotal->totalkirim;
            }

        }

        return view('mutasiperiodeview', ['data' => $data, 'total' => $total, 'totalpcs' => $totalpcs, 'rekap' => $request->rekap]);
    }

}
