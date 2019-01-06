<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Response;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Validator, Mail;
use App\Mail\verifyEmail;

class UserCtrl extends Controller
{
    protected function cekToken(Request $request){
        $credentials = $request->only('email');
        $rules = [
            'email' => 'required|email',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }

        try {
            if (!$token = JWTAuth::parseToken()-> authenticate()) {
                return response()->json(['error'=>true,'msg'=>'User Not found']);
            }
        }
        catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([ 'error'=>true,'msg'=>'Token was expired']);
        }
        catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([ 'error'=>true,'msg'=>'Invalid Token']);
        }
        catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([ 'error'=>true,'msg'=>'Invalid Token']);
        }

        ////////////// dsaddsad
        $data = User::where('email', $request->email)->first();
        if(!$data) {
            return response()->json( 'Error', 404);
        }

        return response()->json($data->api_token, 200);
    }

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
