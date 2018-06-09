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

    public function getitemAJAX(Request $id)
    {
        $item = DB::connection('mysql')->select("call wsm_items('" . $id->name . "')");
        return response()->json(array('item' => $item), 200);
    }

    public function getitem(Request $id)
    {
        $item = DB::connection('mysql')->select("call wsm_items('" . $id->item . "')");
        return view('daftaritem', ['item' => $item]);
        //return response()->json(array('item' => $id->item), 200);
    }

    public function getitemposisi($id)
    {
        $posisi = DB::connection('mysql')->select("call wsm_itemsposisi('" . $id . "')");
        return view('daftaritemposisi', ['posisi' => $posisi]);
        //return response()->json(array('item' => $id), 200);
    }
}
