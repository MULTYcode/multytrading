<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class portalctrl extends Controller
{
    public function index(){
        return view('portal');
    }
}
