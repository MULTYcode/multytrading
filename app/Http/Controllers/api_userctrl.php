<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class api_userctrl extends Controller
{
    protected function ambil(){
        try{
            return response()->json('Berhasil', 200);
        }catch(Exception $e){
            return response($e->getMessage());
        }        
    }
}
