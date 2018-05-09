<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;

class ProfileCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile', array('user' => Auth::user()));
    }

    public function update_avatar(Request $request)
    {
        // Handle the user upload avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatars/' . $filename));
            $user = Auth::user();
            $user->image = $filename;
            $user->save();
        }
        return view('profile', array('user' => Auth::user()));
    }
}
