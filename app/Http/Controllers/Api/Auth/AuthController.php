<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class AuthController extends Controller
{
   /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only(
        'first_name', 
        'last_name',
        'birth',
        'address',
        'gender',
        'phone',
        'email', 
        'password'
    );
        
        $rules = [
            'first_name' => 'required|max:10',
            'last_name' => 'required|max:10',
            'birth' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            //return response()->json(['success'=> false, 'message'=> $validator->messages()]);
            return response()->json($validator->messages(),200);
        }

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $birth = $request->birth;
        $address = $request->address;
        $gender = $request->gender;
        $phone = $request->phone;
        $email = $request->email;
        $password = $request->password;

        $verification_code = str_random(60).$email; //Generate verification code

         $user = User::create([
            'first_name' => $first_name, 
            'last_name' => $last_name, 
            'birth' => $birth,
            'address' => $address,
            'gender' => $gender,
            'phone' => $phone,
            'email' => $email, 
            'password' => Hash::make($password),
            'verifytoken' => $verification_code
            ]); 

        //DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
        $subject = "Please verify your email address.";
        Mail::send('email.verify', ['name' => $first_name, 'verification_code' => $verification_code],
            function($mail) use ($email, $first_name, $subject){
                $mail->to($email, $first_name);
                $mail->subject($subject);
            });

        //return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
        $res['message'] = 'Thanks for signing up! Please check your email to complete your registration.';
        return response()->json($res, 200);
    }

    /**
     * API Verify User
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();
        if(!is_null($check)){
            $user = User::find($check->user_id);
            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }
            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
            return response()->json([
                'success'=> true,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }
        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
    }    

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request){
        if(!$request->email && !$request->password) return response()->json(['error'=>true,'msg'=>'field is required'], 200);
        if(!$request->email) return response()->json(['error'=>true,'msg'=>'email tidak boleh kosong'], 200);
        if(!$request->password) return response()->json(['error'=>true,'msg'=>'password tidak boleh kosong'], 200);
        $credit = $request->only('email','password');

        try {
            // attempt to verify the credentials and create a token for the user
            $user = User::where('email', $request->email)->first();
            if($user){
                if($user->activated != 1 || $user->activated == null){
                    return response()->json(['error'=>true,'msg' => 'Silahkan anda klik link "verifikasi email" yang kami kirim ke email anda, terima kasih'], 200);
                }elseif($user->verified != 1 || $user->verified == null){
                    return response()->json(['error'=>true,'msg' => 'maaf, akun anda belum aktif, silahkan bersabar menunggu verifikasi Muslim Loyalty, terimakasih'], 200);
                }else{
                    $token = JWTAuth::attempt($credit);
                    if(!$token){
                        return Response::json(['error'=>true,'msg' => 'Email atau password salah'], 200);
                    }   
                }
            }else{
                return Response::json(['error'=>true,'msg' => 'Email atau password salah'], 200);
            }

        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return Response::json(['error'=>true,'msg' => 'Gagal login'], 200);
        }

        DB::table('users')->where('email',$request->email)->update(['api_token'=>$token]);

        return response()->json('OK', 200);
    }

    public function loginOri(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }
        
        $credentials['verified'] = 1;
        
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'], 404);
                //$res['success'] = false;
                //$res['error'] = 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.';
                //return response()->json($data, 404);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            //$res['success'] = false;
            //$res['error'] = 'Failed to login, please try again.';
            //return response()->json($res, 500);
            return response()->json(['success'=>false, 'error' => 'Failed to login, please try again.'], 500);
        }
        // all good so return the token
        $api_token = sha1(time());
        $create_token = User::where('email', $request->email)->update(['api_token' => $api_token]);
        // ambil user
        if($create_token){
            $data = User::select('email,token,image')->where('email', $email)->first();        
        }

        //$res['token'] = $token;
        //$res['email'] = $email;
        //return response()->json($res, 200);
        return response()->json($data, 200);

        //return response()->json(['success'=>true, 'data'=>$token], 200);

    }
    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }    

    /**
     * API Recover Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }
        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });
        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }
        return response()->json([
            'success' => true, 'data'=> ['message'=> 'A reset email has been sent! Please check your email.']
        ]);
    }
}
