<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class memberCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function member()
    {
        $membermonth = DB::connection('mysql')->select('call w_membermonth');
        $memberstore = DB::connection('mysql')->select('call w_memberstore');
        $total = 0;
        foreach ($membermonth as $rows) {
            $total = $total + $rows->jmlmember;
        }

        $arealabels = [];
        $areavalues = [];
        foreach ($membermonth as $key => $rows) {
            $arealabels[] = $membermonth[$key]->namabulan;
            $areavalues[] = $membermonth[$key]->jmlmember;
        }

        $chartarea = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($arealabels)
            ->datasets([
                [
                    "label" => "Member per month",
                    'backgroundColor' => 'rgba(0,255,255,0.5)',
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $areavalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'tooltips' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
                'hover' => [
                    'mode' => 'nearest',
                    'intersect' => true
                ],
            ]);

        return view('member', ['membermonth' => $membermonth, 'memberstore' => $memberstore, 'total' => $total, 'chartarea' => $chartarea, '_tahun' => date("Y")]);
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

    public function membertrans()
    {
        return view('membertrans');
    }

    public function membertransview(Request $request)
    {
        $res = DB::connection('mysql')->select("call w_membertrans('" . $request->datefrom . "','" . $request->dateto . "');");

        $jmltrans = 0;
        $jmlpcs = 0;
        $jmlrevenue = 0;
        foreach ($res as $rows) {
            $jmltrans += $rows->ttrans;
            $jmlpcs += $rows->tpcs;
            $jmlrevenue += $rows->tjual;
        }

        return view('membertransview', [
            'res' => $res,
            'jmltrans' => $jmltrans,
            'jmlpcs' => $jmlpcs,
            'jmlrevenue' => $jmlrevenue,
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto
        ]);
    }

    public function membertransdetail($custcode)
    {
        $res = DB::connection('mysql')->select("call w_memberinfo('" . $custcode . "');");
        $grafik = DB::connection('mysql')->select("call w_memberinfografik('" . $custcode . "');");

        $labels = [];
        $values = [];

        foreach ($grafik as $key => $rows) {
            $labels[] = $grafik[$key]->namabulan;
            $values[] = $grafik[$key]->growth;
        }

        $chart = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Member per month",
                    'backgroundColor' => 'rgba(0,255,255,0.5)',
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $values
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'tooltips' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
                'hover' => [
                    'mode' => 'nearest',
                    'intersect' => true
                ],
            ]);

        return view('membertransdetail', ['res' => $res, 'grafik' => $grafik, 'chart' => $chart]);
    }

}
