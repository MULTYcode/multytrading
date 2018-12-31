<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class loadCtrl extends Controller
{
    protected function tampil(){
        return response()->json('Berhasil', 200);
    }
}
