<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class invCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return $this->grn2sls();
    }

    public function grn2sls()
    {
        return view('grn2sls');
    }

    public function grn2slsview(Request $request)
    {
        $sqlstr = "select min(grn.tanggal) as tanggal,grn.kode,sls.nama,sls.brand,sls.class,sls.size as ukuran,sls.warna,sum(grn.grn) as grn,mutasi.mutasi,sls.sls,sls.sisa 
                    from w_grn grn
                    left join(
                    select kode,sum(totalkirim) as mutasi from w_mutasi
                    where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)
                    group by kode
                    ) as mutasi on grn.kode = mutasi.kode
                    left join(
                    select kode,nama,brand,class,size,warna,sum(pcs) as sls,stock as sisa from w_sls_detail
                    where tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date)
                    group by kode,kode,nama,brand,class,size,warna,stock
                    ) as sls on grn.kode = sls.kode
                    where grn.tanggal BETWEEN CAST('" . $request->datefrom . "' AS Date) and CAST('" . $request->dateto . "' AS Date) 
                    and lower(nama) not like '%plastik%' 
                    and lower(nama) not like '%paper%' 
                    and lower(nama) not like '%merchandise%'
                    and lower(nama) not like '%peniti%'
                    and lower(nama) not like '%jarum%'
                    and lower(nama) not like '%one%'
                    and lower(nama) not like '%folded%'
                    and lower(nama) not like '%op%' ";
        $item = $request->item == "" ? "" : "and nama like CONCAT('%" . $request->item . "%')";
        $sqlgroup = "group by grn.kode,sls.nama,sls.brand,sls.class,sls.size,sls.warna,mutasi.mutasi,sls.sls,sls.sisa ";

        // return $sqlstr . $item. $sqlgroup;
        // $dd;

        $res = DB::connection('mysql')->select($sqlstr . $item . $sqlgroup);

        $tgrn = 0;
        $tmutasi = 0;
        $tsales = 0;
        $tstock = 0;

        foreach ($res as $rows) {
            $tgrn += $rows->grn;
            $tmutasi += $rows->mutasi;
            $tsales += $rows->sls;
            $tstock += $rows->sisa;
        }

        return view('grn2slsview', [
            'res' => $res,
            'datefrom' => $request->datefrom,
            'dateto' => $request->dateto,
            'item' => $request->item,
            'tgrn' => $tgrn,
            'tmutasi' => $tmutasi,
            'tsales' => $tsales,
            'tstock' => $tstock
        ]);
    }

    public function grn2slsview_grn($kode)
    {
        $sqlstr = "select notransaksi,tanggal, grn from w_grn where kode='" . $kode . "' order by tanggal";
        $res = DB::connection('mysql')->select($sqlstr);
        $tgrn = 0;
        foreach ($res as $rows) {
            $tgrn += $rows->grn;
        }
        return view('grnhistory', ['res' => $res, 'tgrn' => $tgrn]);
    }

    public function grn2slsview_mutasi($kode)
    {
        $sqlstr = "select notransaksi,tanggal, totalkirim as mutasi from w_mutasi where kode='" . $kode . "' order by tanggal";
        $res = DB::connection('mysql')->select($sqlstr);
        $tmutasi = 0;
        foreach ($res as $rows) {
            $tmutasi += $rows->mutasi;
        }
        return view('mutasihistory', ['res' => $res, 'tmutasi' => $tmutasi]);
    }

    public function grn2slsview_sales($kode)
    {
        $sqlstr = "select id_trans,tanggal, pcs from w_sls_detail where kode='" . $kode . "' order by tanggal";
        $res = DB::connection('mysql')->select($sqlstr);
        $tsls = 0;
        foreach ($res as $rows) {
            $tsls += $rows->pcs;
        }
        return view('saleshistory', ['res' => $res, 'tsls' => $tsls]);
    }


}
