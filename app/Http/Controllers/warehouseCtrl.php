<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class warehouseCtrl extends Controller
{
    public function index(){
        return view('warehouse');
    }
}
