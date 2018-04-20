<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardCtrl extends Controller
{
    protected function jmlMemberToko(Request $request){
        $member = app('db')->connection('tal')->select("call wsm_jumlahmember;");

        $memberpertahun = app('db')->connection('tal')->select("call wsm_memberpertahun(?)",[$request->input('tahun')]);

        $res['member'] = $member;
        $res['memberpertahun'] = $memberpertahun;
        return response()->json($res);
    }

    protected function listToko(Request $request){
        $memberchart = app('db')->connection('tal')->select("call wsm_memberchart(?);",[$request->input('tahun')]);

        $storemember = app('db')->connection('tal')->select("call wsm_storemember(?);",[$request->input('tahun')]);

            $res['memberchart'] = $memberchart;
            $res['member'] = $storemember;
            return response()->json($res);
    }

    protected function todayrevenue(Request $request){
        $revenue = app('db')->connection('tal')->select("call wsm_todayrevenue(?);",[$request->input('tahun')]);
            return response()->json($revenue);
    }

    protected function todayrevenuestore(Request $request){
        $todayrevenuestore = app('db')->connection('tal')->select("call wsm_todayrevenuestore(?);",[$request->input('tahun')]);
            return response()->json($todayrevenuestore);
    }
    
    protected function todayrevenuemonth(Request $request){
        $todayrevenuestore = app('db')->connection('tal')->select("call wsm_todayrevenuemonth(?);",[$request->input('tahun')]);
            return response()->json($todayrevenuestore);
    }

    protected function todayrevenueqty(Request $request){
        $todayrevenuestore = app('db')->connection('tal')->select("call wsm_todayrevenueqty(?);",[$request->input('tahun')]);
            return response()->json($todayrevenuestore);
    }

    protected function todayrevenuestoremonth(Request $request){
        $todayrevenuestore = app('db')->connection('tal')->select("call wsm_todayrevenuestoremonth(?,?);",[$request->input('tahun'),$request->input('kode')]);
            return response()->json($todayrevenuestore);
    }

    protected function avgpricegroup(Request $request){
        $avgpricegroup = app('db')->connection('tal')->select("call wsm_avgpricegroup(?,?);",[$request->input('bulan'),$request->input('tahun')]);    
        $res['price'] = $avgpricegroup;
            return response()->json($res);
    }

    protected function avgpricedetail(Request $request){
        $avgpricedetail = app('db')->connection('tal')->select("call wsm_avgpricedetail(?,?,?);",[$request->input('bulan'),$request->input('tahun'),$request->input('harga')]);    
        $res['detail'] = $avgpricedetail;
            return response()->json($res);
    }

    protected function invitem(Request $request){
        $invitem = app('db')->connection('tal')->select("call wsm_invitem(?);",['%'.$request->input('name').'%']);
        $res['list'] = $invitem;
            return response()->json($res);
    }

    protected function topsold(Request $request){
        $topsold = app('db')->connection('tal')->select("call wsm_topsold(?,?);",[$request->input('bulan'),$request->input('tahun')]);
        $res['topsold'] = $topsold;
        return response()->json($res);
   }

   protected function toprevenue(Request $request){
        $sql = app('db')->connection('tal')->select("call wsm_toprevenue(?,?);",[$request->input('bulan'),$request->input('tahun')]);
        $res['toprevenue']=$sql;
        return response()->json($res);
    }

    protected function toprevenueitem(Request $request){
        $sql = app('db')->connection('tal')->select("call wsm_toprevenueitem(?,?,?);",[$request->input('bulan'),$request->input('tahun'),'%'.$request->input('name').'%']);

        $res['toprevenueitem']=$sql;
        return response()->json($res);
    }

    protected function customerTransaction(Request $request){
        $sql = app('db')->connection('tal')->select("call wsm_custtrans(?);",[$request->input('tahun')]);

        $res['cr']=$sql;
        return response()->json($res);
    }

    protected function customerCRmonth(Request $request){
        $member = app('db')->connection('tal')->select("call wsm_crmonth(?);",[$request->input('tahun')]);
        $res['member']=$member;
        return response()->json($res);
    }

    protected function customerCRstore(Request $request){
        $member = app('db')->connection('tal')->select("call wsm_crstore(?);",[$request->input('tahun')]);
        $res['member']=$member;
        return response()->json($res);
    }

    protected function invperiode(Request $request){
        $inv = app('db')->connection('tal')->select("call wsm_saldoperiode(?);",[$request->input('tglakhir')]);
        $res['inv']=$inv;
        return response()->json($res);
    }

    protected function getdivisi(Request $request){
        $divisi = app('db')->connection('tal')->select("select dnama from m1_division;");
        $res['divisi']=$divisi;
        return response()->json($res);
    }
}
