<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class salesCtrl extends Controller
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
        if ($request->rekap == 1) {
            $sqlstr = "select kode,nama,artikel,brand,class,subclass,size,warna,hjual,sum(pcs) as pcs,sum(total_jual) as total_jual,stock 
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
            if ($request->item == "") {
                $res = DB::connection('mysql')->select($sqlstr . "group by kode,nama,artikel,brand,class,subclass,size,warna,hjual,stock");
            } else {
                $res = DB::connection('mysql')->select($sqlstr . " and nama like CONCAT('%" . $request->item . "%') 
                group by kode,nama,artikel,brand,class,subclass,size,warna,hjual,stock");
            }
        } else {
            $sqlstr = "select tanggal,kode,nama,artikel,brand,class,subclass,size,warna,store,hjual,pcs,total_jual,stock 
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
            if ($request->item == "") {
                $res = DB::connection('mysql')->select($sqlstr);
            } else {
                $res = DB::connection('mysql')->select($sqlstr . " and nama like CONCAT('%" . $request->item . "%')");
            }
        }

        $tpcs = 0;
        $tjual = 0;
        $tstock = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
            $tstock += $rows->stock;
        }

        return view('salesperiodeview', [
            'tjual' => $tjual,
            'tpcs' => $tpcs,
            'tstock' => $tstock,
            'res' => $res,
            'store' => 'ALL',
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto,
            'rekap' => $request->rekap
        ]);
    }

    public function salesbybrand()
    {
        return view('slsbybrand');
    }

    public function salesbybrandview(Request $request)
    {
        $sqlstr = "select brand,sum(pcs) as pcs,sum(total_jual) as total_jual,sum(stock) as stock
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date) 
            group by brand order by sum(pcs) desc";
        $res = DB::connection('mysql')->select($sqlstr);

        $tpcs = 0;
        $tjual = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
        }

        return view('slsbybrandview', [
            'res' => $res,
            'tpcs' => $tpcs,
            'tjual' => $tjual,
            'store' => '',
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto
        ]);
    }

    public function getstorebrand($store, $datefrom, $dateto)
    {
        $sqlstr = "select brand,sum(pcs) as pcs,sum(total_jual) as total_jual,sum(stock) as stock
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $datefrom . "' AS Date) and CAST('" . $dateto . "' AS Date)
            and store like '%" . $store . "%' 
            group by brand order by sum(pcs) desc";
        $res = DB::connection('mysql')->select($sqlstr);

        $tpcs = 0;
        $tjual = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
        }

        return view('slsbybrandview', [
            'res' => $res,
            'tjual' => $tjual,
            'tpcs' => $tpcs,
            'store' => $store,
            'datefrom' => $datefrom,
            'dateto' => $dateto
        ]);
    }

    public function salesbystore()
    {
        return view('slsbystore');
    }

    public function salesbystoreview(Request $request)
    {
        $sqlstr = "select store,sum(pcs) as pcs,sum(total_jual) as total_jual,sum(stock) as stock
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date) 
            group by store order by sum(pcs) desc";
        $res = DB::connection('mysql')->select($sqlstr);

        $tpcs = 0;
        $tjual = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
        }

        return view('slsbystoreview', [
            'res' => $res,
            'tjual' => $tjual,
            'tpcs' => $tpcs,
            'brand' => '',
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto
        ]);
    }

    public function getstore($brand, $datefrom, $dateto)
    {
        $sqlstr = "select store,sum(pcs) as pcs,sum(total_jual) as total_jual,sum(stock) as stock
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $datefrom . "' AS Date) and CAST('" . $dateto . "' AS Date)
            and brand like '%" . $brand . "%' 
            group by store order by sum(pcs) desc";
        $res = DB::connection('mysql')->select($sqlstr);

        $tpcs = 0;
        $tjual = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
        }

        return view('slsbystoreview', [
            'res' => $res,
            'tjual' => $tjual,
            'tpcs' => $tpcs,
            'brand' => $brand,
            'datefrom' => $datefrom,
            'dateto' => $dateto
        ]);
    }

    public function getsalesitems($store, $brand, $datefrom, $dateto)
    {
        $sqlstr = "select kode,nama,artikel,brand,class,subclass,size,warna,hjual,sum(pcs) as pcs,sum(total_jual) as total_jual,stock 
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $datefrom . "' AS Date) and CAST('" . $dateto . "' AS Date)
            and brand = '" . $brand . "'";
        if ($store == "ALL") {
            $res = DB::connection('mysql')->select($sqlstr . "group by kode,nama,artikel,brand,class,subclass,size,warna,hjual,stock");
        } else {
            $res = DB::connection('mysql')->select($sqlstr . " and store like CONCAT('%" . $store . "%') 
                group by kode,nama,artikel,brand,class,subclass,size,warna,hjual,stock");
        }

        $tpcs = 0;
        $tjual = 0;
        $tstock = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
            $tstock += $rows->stock;
        }

        return view('salesperiodeview', [
            'tjual' => $tjual,
            'tpcs' => $tpcs,
            'tstock' => $tstock,
            'res' => $res,
            'rekap' => 1,
            'store' => $store,
            'datefrom' => $datefrom,
            'dateto' => $dateto
        ]);
    }

    public function salesbyclass()
    {
        return view('salesbyclass');
    }

    public function getsalesbyclass(Request $request)
    {
        if ($request->rekap == 1) {
            if ($request->class == "") {
                $sqlstr = "select class,sum(pcs) as pcs,sum(total_jual) as total_jual,sum(stock) as stock 
                from w_sls_detail
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
                $res = DB::connection('mysql')->select($sqlstr . "group by class");
            } else {
                $sqlstr = "select class,sum(pcs) as pcs,sum(total_jual) as total_jual,sum(stock) as stock 
                from w_sls_detail
                where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
                $res = DB::connection('mysql')->select($sqlstr . " and class like CONCAT('%" . $request->class . "%') 
                group by class");
            }
        } else {
            $sqlstr = "select tanggal,kode,nama,artikel,brand,class,subclass,size,warna,store,hjual,pcs,total_jual,sum(stock) as stock 
            from w_sls_detail
            where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)";
            if ($request->class == "") {
                $res = DB::connection('mysql')->select($sqlstr . " group by tanggal,kode,nama,artikel,brand,class,subclass,size,warna,store,hjual,pcs,total_jual");
            } else {
                $res = DB::connection('mysql')->select($sqlstr . " and class like CONCAT('%" . $request->class . "%') 
                group by tanggal,kode,nama,artikel,brand,class,subclass,size,warna,store,hjual,pcs,total_jual");
            }
        }

        $tpcs = 0;
        $tjual = 0;
        $tstock = 0;
        foreach ($res as $rows) {
            $tpcs += $rows->pcs;
            $tjual += $rows->total_jual;
            $tstock += $rows->stock;
        }

        return view('salesbyclassview', [
            'tjual' => $tjual,
            'tpcs' => $tpcs,
            'tstock' => $tstock,
            'res' => $res,
            'rekap' => $request->rekap,
            'class' => $request->class,
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto
        ]);

    }

    public function salesbycategory()
    {
        $category = DB::connection('mysql')->select('call w_sls_categori');
        $categorylabels = [];
        $categoryvalues = [];
        $total = 0;
        foreach ($category as $key => $rows) {
            $total += $rows->total;
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

        return view('salesbycategory', [
            'total' => $total,
            'category' => $category,
            'chartcategory' => $chartcategory,
        ]);
    }

    public function  salesachievement()
    {
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

        return view(
            'salesarchivment',
            [
                'area' => $area,
                'chartarea' => $chartarea,
            ]
        );
    }

}

