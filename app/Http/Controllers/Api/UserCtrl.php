<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
//use Egulias\EmailValidator\EmailValidator;
//use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Support\Facades\Response;

//use Illuminate\Support\Str;
use Mail;
use App\Mail\verifyEmail;

class UserCtrl extends Controller
{
    protected function register(Request $request){
        try{

/*             $checkEmail = User::where('email',$request->input('email'))->count();
            if($checkEmail > 0){
                $return = array(
                    "error" => true,
                    "msg" => "Email sudah terdaftar"
                );
                return response()->json($return);
            } */

/*             $hasher = app()->make('hash');
            User::create([
                'first_name'    => $request->input('firstname'),
                'last_name'     => $request->input('lastname'),
                'birth'         => $request->input('birth'),
                'address'       => $request->input('address'),
                'gender'        => $request->input('gender'),
                'phone'         => $request->input('phone'),
                'email'         => $request->input('email'),
                'password'      => $hasher->make($request->input('password')),
            ]); */

            //$this->sendEmail($request->input('email'));
            //return response()->json(['error'=>false,'msg'=>'Success']); 

$emailhtml = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
</head>
<body>
Thanks for using MyErp Dashboard! Please confirm your email address by clicking on the link below.<br><br>

<a href=''>Verified Email</a></p><br><br>

If you did not sign up for a MyErp Dashboard account please disregard this email.</p><br><br>

Happy monitoring! <br>
The WSM Team
</body>
</html>";

             Mail::raw($emailhtml, function($message)
            {
                $message->subject('Hi There!!');
                $message->from("noreply@wesmartmodule.com", "Test Email");
                $message->to('mhdwasiman@gmail.com');
            }); 
    
        }catch(\Illuminate\Database\QueryException $ex){
            return response($ex->getMessage());
        }
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    protected function cektoken(Request $request){
        try{
            $email = $request->input('email');
            $login = User::where('email', $email)->first();
            if (!$login) {
                $res['status'] = 'error';
                $res['msg'] = 'Your session is expired';
                return response()->json($res);
            }
            else {
                return response()->json(['token'=>$login->api_token]);
            }    
        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json($ex->getMessage());
        }
    }

    protected function login(Request $request){
        $hasher = app()->make('hash');
        $email = $request->input('email');
        $password = $request->input('password');
        $login = User::where('email', $email)->first();
        if (!$login) {
            $res['status'] = 'error';
            $res['msg'] = 'Your email or password incorrect!';
            return response($res);
        }else{
            if($login->activated != 1 || $login->activated == null){
                return response()->json(['error'=>true,'msg' => 'Silahkan anda klik link verifikasi yang kami kirim ke email anda'], 200);
            }elseif($login->activated != 1 || $login->activated == null){
                return response()->json(['error'=>true,'msg' => 'Maaf, akun anda belum aktif, silahkan menghubungi administrator'], 200);
            }
            if ($hasher->check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['status'] = 'success';
                    $res['api_token'] = $api_token;
                    $res['user'] = $login;
                    return response($res);
                }
            }else{
                $res['status'] = 'error';
                $res['msg'] = 'You email or password incorrect!';
                return response($res);
            }
        }
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
