<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Context;

class cryearCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cryear = DB::connection('mysql')->select('call wsm_cryear');

        $cryearlabelsA = [];
        $cryearvaluesA = [];

        $cryearlabelsB = [];
        $cryearvaluesB = [];

        foreach ($cryear as $key => $rows) {
            if ($cryear[$key]->tahun == date("Y")) {
                $cryearlabelsA[] = $cryear[$key]->bulan;
                $cryearvaluesA[] = $cryear[$key]->cr;
            } else {
                $cryearlabelsB[] = $cryear[$key]->bulan;
                $cryearvaluesB[] = $cryear[$key]->cr;
            }
        }

        $chartarea = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
            ->labels($cryearlabelsB)
            ->datasets([
                [
                    "label" => "Year 2017",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $cryearvaluesB,
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
                    'data' => $cryearvaluesA,
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

        return view('cryear', ['cryear' => $cryear, 'chartarea' => $chartarea]);
    }
}
