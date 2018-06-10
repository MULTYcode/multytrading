<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardwebCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // cr - pcs - rupiah
        $sls = DB::connection('mysql')->select('call wsm_cr');
        // member
        $member = DB::connection('mysql')->select('call wsm_jumlahmember');

        /*=== TOP AREA ===*/
        $area = DB::connection('mysql')->select('call wsm_toparea');
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
        $category = DB::connection('mysql')->select('call wsm_topcategory');
        $categorylabels = [];
        $categoryvalues = [];
        foreach ($category as $key => $rows) {
            $categorylabels[] = $category[$key]->cat;
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
            'chartcategory' => $chartcategory,
        ]);

    }

}