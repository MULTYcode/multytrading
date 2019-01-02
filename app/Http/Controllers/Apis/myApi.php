<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class myApi extends Controller
{
    protected function ambil(){
        try{
            return response()->json('Berhasil', 200);
        }catch(Exception $e){
            return response($e->getMessage());
        }        
    }
}
