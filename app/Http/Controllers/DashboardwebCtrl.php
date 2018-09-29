<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DashboardwebCtrl extends Controller
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
                return $this->dashboard();
                break;
            }
        }
        return view('noaccess');
    }

    private function dashboard()
    {
                // cr - pcs - rupiah
        $sls = DB::connection('mysql')->select('call w_sls_rekap');
                // member
        $member = DB::connection('mysql')->select('call w_member');
        
                /*=== TOP AREA ===*/
        $area = DB::connection('mysql')->select('call w_target_area');
        $arealabels = [];
        $areavalues = [];
        foreach ($area as $key => $rows) {
            $arealabels[] = $area[$key]->area;
            $areavalues[] = $area[$key]->rupiah;
        }

        $chartarea = app()->chartjs
            ->name('pieChartArea')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels($arealabels)
            ->datasets([
                [
                    "label" => "Sales By Area",
                    'backgroundColor' => [
                        'rgba(0,0,255,0.5)',
                        'rgba(255,0,0,0.5)',
                        'rgba(0,255,255,0.5)',
                    ],
                    'data' => $areavalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ]);
        
                /* SALES TOP CATEGORI */
        $category = DB::connection('mysql')->select('call w_sls_categori');
        $categorylabels = [];
        $categoryvalues = [];
        $catjual = 0;
        $catpcs = 0;
        foreach ($category as $key => $rows) {
            $catjual += $rows->total;
            $catpcs += $rows->pcs;
            $categorylabels[] = $category[$key]->categori;
            $categoryvalues[] = $category[$key]->total;
        }

        $chartcategory = app()->chartjs
            ->name('barChartCategory')
            ->type('horizontalBar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($categorylabels)
            ->datasets([
                [
                    "label" => "Top 10 categorys",
                    'backgroundColor' => [
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                        'rgba(0,128,0, 0.5)',
                    ],
                    'data' => $categoryvalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ]);

        return view('dashboard', [
            'member' => $member,
            'sls' => $sls,
            'category' => $category,
            'area' => $area,
            'chartarea' => $chartarea,
            'category' => $category,
            'catpcs' => $catpcs,
            'catjual' => $catjual,
            'chartcategory' => $chartcategory,
        ]);
    }

}