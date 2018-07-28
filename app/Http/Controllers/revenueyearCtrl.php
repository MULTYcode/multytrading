<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class revenueyearCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $rekaprevenue = DB::connection('mysql')->select('call w_rekaprevenue');
        $revenueyear = DB::connection('mysql')->select('call w_revenueyear');
        $storerank = DB::connection('mysql')->select('call w_storerank');

        $cagrAwal = 0;
        $cagrAkhir = 0;
        $cagrData = 0;
        $cagr = [];

        foreach ($rekaprevenue as $key => $rekap) {
            if ($key == 0) {
                $cagrAwal = $rekap->revenue;
            } else {
                $cagrAkhir = $rekap->revenue;
            }
            $cagrData = $key;
            if ($cagrData == 0) {
                $cagr[$key] = 0;
            } else {
                $cagr[$key] = round(pow(($cagrAkhir / $cagrAwal), (1 / $cagrData)) - 1, 2);
            }
        }

        $revenueyearlabelsA = [];
        $revenueyearvaluesA = [];

        $revenueyearlabelsB = [];
        $revenueyearvaluesB = [];

        foreach ($revenueyear as $key => $rows) {
            if ($revenueyear[$key]->tahun == date("Y")) {
                $revenueyearlabelsA[] = $revenueyear[$key]->namabulan;
                $revenueyearvaluesA[] = $revenueyear[$key]->revenue;
            } elseif($revenueyear[$key]->tahun == date("Y")-1) {
                $revenueyearlabelsB[] = $revenueyear[$key]->namabulan;
                $revenueyearvaluesB[] = $revenueyear[$key]->revenue;
            }
        }

        $chartarea = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
            ->labels($revenueyearlabelsB)
            ->datasets([
                [
                    "label" => "Year 2017",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $revenueyearvaluesB,
                    'fill' => false
                ],
                [
                    "label" => "Year 2018",
                    'backgroundColor' => "rgba(0,255,0, 0.31)",
                    'borderColor' => "rgba(0,255,0, 0.7)",
                    "pointBorderColor" => "rgba(0,255,0, 0.7)",
                    "pointBackgroundColor" => "rgba(0,255,0, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $revenueyearvaluesA,
                    'fill' => false
                ],
            ])
            ->options(
                [
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
                ]
            );

        return view('revenueyear', [
            'revenueyear' => $revenueyear,
            'chartarea' => $chartarea,
            'rekaprevenue' => $rekaprevenue,
            'storerank' => $storerank,
            'cagr' => $cagr,
            '_year' => $storerank[0]->tahun
        ]);

    }
}
