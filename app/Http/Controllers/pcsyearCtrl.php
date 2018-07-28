<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pcsyearCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pcsyear = DB::connection('mysql')->select('call w_pcsyear');

        $pcsyearlabelsA = [];
        $pcsyearvaluesA = [];

        $pcsyearlabelsB = [];
        $pcsyearvaluesB = [];

        foreach ($pcsyear as $key => $rows) {
            if ($pcsyear[$key]->tahun == date("Y")) {
                $pcsyearlabelsA[] = $pcsyear[$key]->namabulan;
                $pcsyearvaluesA[] = $pcsyear[$key]->pcs;
            } elseif ($pcsyear[$key]->tahun == date("Y") - 1) {
                $pcsyearlabelsB[] = $pcsyear[$key]->namabulan;
                $pcsyearvaluesB[] = $pcsyear[$key]->pcs;
            }
        }

        $chartarea = app()->chartjs
            ->name('lineChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 150])
            ->labels($pcsyearlabelsB)
            ->datasets([
                [
                    "label" => "Year 2017",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $pcsyearvaluesB,
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
                    'data' => $pcsyearvaluesA,
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

        return view('pcsyear', ['pcsyear' => $pcsyear, 'chartarea' => $chartarea]);

    }
}
