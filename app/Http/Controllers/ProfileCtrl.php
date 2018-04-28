<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id){
        $user = User::where('email',$id)->first();
        if($user){
            return view('profile',['profile'=>$user]);
        }
    }
}
