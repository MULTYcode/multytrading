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

        /*=== TOP SOLD ===*/
        $sold = DB::connection('mysql')->select('call wsm_topsold');
        $soldlabels = [];
        $soldvalues = [];
        foreach ($sold as $key => $rows) {
            $soldlabels[] = $sold[$key]->namabarang;
            $soldvalues[] = $sold[$key]->qty;
        }

        $chartjs1 = app()->chartjs
            ->name('barChartTest1')
            ->type('horizontalBar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($soldlabels)
            ->datasets([
                [
                    "label" => "Top 10 Items Sold",
                    'backgroundColor' => [
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                        'rgba(0,0,128,0.5)',
                    ],
                    'data' => $soldvalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ]);

        
        //top revenue
        $revenue = DB::connection('mysql')->select('call wsm_toprevenue');
        $revenuelabels = [];
        $revenuevalues = [];
        foreach ($revenue as $key => $rows) {
            $revenuelabels[] = $revenue[$key]->namabarang;
            $revenuevalues[] = $revenue[$key]->harga;
        }

        $chartjs2 = app()->chartjs
            ->name('barChartTest2')
            ->type('horizontalBar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($revenuelabels)
            ->datasets([
                [
                    "label" => "Top 10 Revenues",
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
                    'data' => $revenuevalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ]);

        /*======= TOP WARNA =======*/
        $warna = DB::connection('mysql')->select('call wsm_topwarna');
        $warnalabels = [];
        $warnavalues = [];
        foreach ($warna as $key => $rows) {
            $warnalabels[] = $warna[$key]->warna;
            $warnavalues[] = $warna[$key]->total;
        }

        $barChartWarna = app()->chartjs
            ->name('barChartWarna')
            ->type('horizontalBar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($warnalabels)
            ->datasets([
                [
                    "label" => "Top 10 Colour",
                    'backgroundColor' => [
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                        'rgba(128,0,0, 0.5)',
                    ],
                    'data' => $warnavalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ]);
        
        /*======= TOP UKURAN =======*/
        $ukuran = DB::connection('mysql')->select('call wsm_topukuran');
        $ukuranlabels = [];
        $ukuranvalues = [];
        foreach ($ukuran as $key => $rows) {
            $ukuranlabels[] = $ukuran[$key]->ukuran;
            $ukuranvalues[] = $ukuran[$key]->total;
        }

        $barChartUkuran = app()->chartjs
            ->name('barChartUkuran')
            ->type('horizontalBar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($ukuranlabels)
            ->datasets([
                [
                    "label" => "Top 10 Size",
                    'backgroundColor' => [
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                        'rgba(128,128,0, 0.5)',
                    ],
                    'data' => $ukuranvalues
                ]
            ])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
            ]);

        return view('dashboard', [
            'member' => $member,
            'sls' => $sls,
            'sold' => $sold,
            'revenue' => $revenue,
            'chartjs1' => $chartjs1,
            'chartjs2' => $chartjs2,
            'warna' => $warna,
            'barChartWarna' => $barChartWarna,
            'ukuran' => $ukuran,
            'barChartUkuran' => $barChartUkuran,
            'area' => $area,
            'chartarea' => $chartarea,
        ]);
    }


}