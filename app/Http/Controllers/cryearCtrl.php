<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Context;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class cryearCtrl extends Controller
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
                return $this->onload();
                break;
            }
        }
        return view('noaccess');
    }

    private function onload()
    {
        $cryear = DB::connection('mysql')->select('call w_cryear');

        $cryearlabelsA = [];
        $cryearvaluesA = [];

        $cryearlabelsB = [];
        $cryearvaluesB = [];

        foreach ($cryear as $key => $rows) {
            if ($cryear[$key]->tahun == date("Y")) {
                $cryearlabelsA[] = $cryear[$key]->namabulan;
                $cryearvaluesA[] = $cryear[$key]->cr;
            } elseif ($cryear[$key]->tahun == date("Y") - 1) {
                $cryearlabelsB[] = $cryear[$key]->namabulan;
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
