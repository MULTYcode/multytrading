<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Response;

use Validator, Mail;
use App\Mail\verifyEmail;

class UserCtrl extends Controller
{
    protected function getuser(Request $request)
    {
        try{
            $token = str_replace('Bearer ','',$request->header('Authorization'));
            return User::where('api_token', $token)->get();    
        }catch(Exception $e){
            return response($e->getMessage());
        }
    }

    protected function updateuser(Request $request)
    {
        try{
            $name = $request->input('name');
            $token = str_replace('Bearer ','',$request->header('Authorization'));
            if(User::where('api_token', $token)->update(['name'=>$name])){
                 return response()->json(['error'=>false,'msg'=>'Success!']);
            }else{
             return response()->json(['error'=>true,'msg'=>'Error']);
            }
        }catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage());
        }
    }

    protected function gantipwduser(Request $request)
    {
        $hasher = app()->make('hash');
        $passwordold = $request->input('passold');
        $passwordnew = $hasher->make($request->input('passnew'));
        $token = str_replace('Bearer ','',$request->header('Authorization'));
        $res = User::where('api_token', $token)->first();
        if(!$res){
            return response()->json(['error'=>true,'msg'=>'Authorization failed!']);
        }else{
            if($hasher->check($passwordold, $res->password)){
                if(User::where('api_token', $token)->update(['password'=>$passwordnew])){
                    return response()->json(['error'=>false,'msg'=>'Success!']);
                }else{
                    return response()->json(['error'=>true,'msg'=>'Technical error!']);
                }                        
            }else{
                return response()->json(['error'=>true,'msg'=>'Password lama salah!']);
            }
        }
    }

    protected function picuser(Request $request)
    {
       $this->validate($request, [
           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       $image = $request->file('image');
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $destinationPath = base_path('public/images');
       $image->move($destinationPath, $input['imagename']);

       $token = str_replace('Bearer ','',$request->header('Authorization'));
       if(User::where('api_token', $token)->update(['image'=>url('images/'.$input['imagename'])])){
            return response()->json('success');
       }
    }

    protected function getpicuser(Request $request)
    {
        try{
            $token = str_replace('Bearer ','',$request->header('Authorization'));
            return User::select('image')->where('api_token',$token)->get(); 
        }catch(Exceptions $e){
            return response($e->getmessage());
        }
    }
}
