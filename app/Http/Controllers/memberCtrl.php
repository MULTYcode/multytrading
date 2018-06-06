<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class memberCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $membermonth = DB::connection('mysql')->select('call wsm_membermonth');
        $memberstore = DB::connection('mysql')->select('call wsm_memberstore');
        $total = 0;
        foreach ($membermonth as $rows) {
            $total = $total + $rows->jmlmember;
        }
        return view('member', ['membermonth' => $membermonth, 'memberstore' => $memberstore, 'total' => $total]);
    }
    public function trans($bulan)
    {
        $res = DB::connection('mysql')->select("call wsm_newmember('" . $this->namabulan2int($bulan) . "')");
        return view('membertransaksi', ['trans' => $res]);
    }
    private function namabulan2int($nama)
    {
        $res = 0;
        switch ($nama) {
            case 'Jan':
                $res = 1;
                break;
            case 'Feb':
                $res = 2;
                break;
            case 'Mar':
                $res = 3;
                break;
            case 'Apr':
                $res = 4;
                break;
            case 'Mei':
                $res = 5;
                break;
            case 'Jun':
                $res = 6;
                break;
            case 'Jul':
                $res = 7;
                break;
            case 'Agu':
                $res = 8;
                break;
            case 'Sep':
                $res = 9;
                break;
            case 'Okt':
                $res = 10;
                break;
            case 'Nov':
                $res = 11;
                break;
            case 'Des':
                $res = 12;
                break;
        }
        return $res;
    }
}
