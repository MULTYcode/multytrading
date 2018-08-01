<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class salesCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /*=== TOP SOLD ===*/
        $sold = DB::connection('mysql')->select('call w_topsold');
        $soldlabels = [];
        $soldvalues = [];
        foreach ($sold as $key => $rows) {
            $soldlabels[] = $sold[$key]->namabarang;
            $soldvalues[] = $sold[$key]->qty;
        }

        $chartSold = app()->chartjs
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
        
                
        /* TOP REVENUE */
        $revenue = DB::connection('mysql')->select('call w_toprevenue');
        $revenuelabels = [];
        $revenuevalues = [];
        foreach ($revenue as $key => $rows) {
            $revenuelabels[] = $revenue[$key]->namabarang;
            $revenuevalues[] = $revenue[$key]->harga;
        }

        $chartrevenue = app()->chartjs
            ->name('barChartRevenue')
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
        $warna = DB::connection('mysql')->select('call w_topwarna');
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
        $ukuran = DB::connection('mysql')->select('call w_topukuran');
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

        return view('sales', [
            'chartrevenue' => $chartrevenue,
            'chartsold' => $chartSold,
            'warna' => $warna,
            'barChartWarna' => $barChartWarna,
            'ukuran' => $ukuran,
            'barChartUkuran' => $barChartUkuran,
        ]);
    }

    public function sales()
    {
        return view('salesfind');
    }

    public function salesfindview(Request $kode)
    {
        $res = DB::connection('mysql')->select("call wsm_findsaleskode('" . $kode->item . "')");
        $jmlqty = 0;
        $jmltotal = 0;
        foreach ($res as $rows) {
            $jmlqty += $rows->pcs;
            $jmltotal += $rows->rupiah;
        }
        return view('salesfindview', ['res' => $res, 'tpcs' => $jmlqty, 'ttotal' => $jmltotal]);
    }

    public function salesperiode()
    {
        return view('salesperiode');
    }

    public function salesperiodeview(Request $request)
    {
        $sqlstr = "select tanggal,kode,nama,artikel,brand,class,subclass,size,warna,store,hjual,pcs,total_jual,stock 
                from w_sls_detail
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
        if ($request->item == "") {
            $res = DB::connection('mysql')->select($sqlstr);
        } else {
            $res = DB::connection('mysql')->select($sqlstr . " and nama like CONCAT('%" . $request->item . "%')");
        }
        return view('salesperiodeview', ['res' => $res]);
    }


}

