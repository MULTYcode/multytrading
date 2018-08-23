<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class catalogCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('catalog');
    }

    // public function getitemAJAX(Request $id)
    // {
    //     $item = DB::connection('mysql')->select("call w_items('" . $id->name . "')");
    //     return response()->json(array('item' => $item), 200);
    // }

    public function getitem(Request $id)
    {
        $item = DB::connection('tal')->select("select mst.bkode as kode, mst.bnama as nama, kat.mnama as brand, cl.cnama as class, c.scnama as subclass, ukuran.snama as size, 
        warna.cnama as warna, mst.bhargajual1 as hjual,mst.bstok as stock 
        from myerpplus_tal.m1_item mst
        left join myerpplus_tal.m1_merk kat on kat.mkode=mst.bamerk 
        left join myerpplus_tal.m1_subclass c on c.sckode=mst.bsubkelas
        left JOIN myerpplus_tal.m1_class cl ON cl.ckode = mst.bakelas
        left join myerpplus_tal.m1_size ukuran on ukuran.skode=mst.baukuran
        left join myerpplus_tal.m1_color warna on warna.ckode=mst.bawarna
        where mst.bnama like CONCAT('%','" . $id->item . "','%');");

        $tstock=0;
        foreach($item as $rows){
            $tstock += $rows->stock;
        }

        return view('daftaritem', ['item' => $item, 'tstock'=>$tstock]);
        //return response()->json(array('item' => $id->item), 200);
    }

    public function getitemposisi($id)
    {
        $posisi = DB::connection('tal')->select("select i.bkode as kode, i.bnama as namabarang, i.bhargajual1 as hargajual, d.cnama as warna, e.snama as ukuran, isw.kgudang AS 'gudang', wh.wnama AS 'namagudang', sum(isw.stok) AS 'stok' 
        from myerpplus_tal.m1_item_stock_warehouse isw 
        join myerpplus_tal.m1_item i on isw.idbarang = i.bid 
        left join myerpplus_tal.m1_warehouse wh on isw.kgudang = wh.wkode
        join myerpplus_tal.m1_color d on d.ckode=i.bawarna
        join myerpplus_tal.m1_size e on e.skode=i.baukuran
        WHERE i.bkode LIKE CONCAT('%'," . $id . ",'%')
        group by i.bnama, isw.kgudang, wh.wnama
        ORDER BY isw.kgudang, i.bkode;");
        return view('daftaritemposisi', ['posisi' => $posisi]);
        //return response()->json(array('item' => $id), 200);
    }
}
