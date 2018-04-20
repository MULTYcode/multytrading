<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class viewctrl extends Controller
{
    public function index()
    {
        return view('/menu');
    }
}
