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
        return view('warehouse');
    }

    public function mutasiperiodeview(Request $request)
    {
        if ($request->rekap == 1) {

            if ($request->tgl == 1) {
                $sqlstr = "select kode,nama,brand,class,warna,ukuran,asal,tujuan,sum(totaljual) as tjual,sum(totalkirim) as tqty from w_mutasi
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
            } else {
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

            if ($request->tgl == 1) {
                $sqlstr = "select * from w_mutasi
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
            } else {
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

    public function mutasistore()
    {
        return view('mutasistore');
    }

    public function mutasistoreview(Request $request)
    {
        $res = DB::connection('mysql')->select("select asal, sum(totalkirim) tpcs, sum(totaljual) tjual
                                                from w_mutasi where 
                                                tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date) 
                                                group by asal");

        $totpcs = 0;
        $totvalue = 0;
        foreach ($res as $restotal) {
            $totpcs = $totpcs + $restotal->tpcs;
            $totvalue = $totvalue + $restotal->tjual;
        }

        return view('mutasistoreview', ['res' => $res, 'totpcs' => $totpcs, 'totvalue' => $totvalue, 'datefrom' => $request->datefrom, 'dateto' => $request->dateto]);
    }

    public function mutasibrand()
    {
        return view('mutasibrand');
    }

    public function mutasibrandview(Request $request)
    {
        $res = DB::connection('mysql')->select("select brand, sum(totalkirim) tpcs, sum(totaljual) tjual
                                                from w_mutasi where 
                                                tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date) 
                                                group by brand");

        $totpcs = 0;
        $totvalue = 0;
        foreach ($res as $restotal) {
            $totpcs = $totpcs + $restotal->tpcs;
            $totvalue = $totvalue + $restotal->tjual;
        }

        return view('mutasibrandview', ['res' => $res, 'totpcs' => $totpcs, 'totvalue' => $totvalue, 'datefrom' => $request->datefrom, 'dateto' => $request->dateto]);
    }

    public function mutasiclass()
    {
        return view('mutasiclass');
    }

    public function mutasiclassview(Request $request)
    {
        $res = DB::connection('mysql')->select("select class, sum(totalkirim) tpcs, sum(totaljual) tjual
                                                from w_mutasi where 
                                                tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date) 
                                                group by class");

        $totpcs = 0;
        $totvalue = 0;
        foreach ($res as $restotal) {
            $totpcs = $totpcs + $restotal->tpcs;
            $totvalue = $totvalue + $restotal->tjual;
        }

        return view('mutasiclassview', ['res' => $res, 'totpcs' => $totpcs, 'totvalue' => $totvalue, 'datefrom' => $request->datefrom, 'dateto' => $request->dateto]);
    }

}
