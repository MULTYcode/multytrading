<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\dt_routes;
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
        $sls = DB::connection('tal')->select('call wsm_cr');

        // member
        $member = DB::connection('tal')->select('call wsm_jumlahmember');

        return view('dashboard', ['member' => $member, 'sls' => $sls]);

    }

}
