<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dt_routes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //update
        return view('home',['routes'=>dt_routes::all()]);
    }

}
