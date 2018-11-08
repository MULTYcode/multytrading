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

    public function profile()
    {
    return view('profile'/*, array('user' => Auth::user())*/);
    }

    public function update_avatar(Request $request)
    {
        // Handle the user upload avatar
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500000',
        // ]);

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

    public function update_profile(Request $request)
    {
        // Handle the user update profile
        $user = Auth::user();
        $user->name = $request['inputName'];
        $user->skill = $request['inputSkill'];
        $user->info = $request['inputInfo'];
        $user->save();
        return redirect(route('profile'));
    }
}
