<?php

use Illuminate\Http\Request;
use App\User;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {

    /*     
    Route::post('/register', 'UserCtrl@register');
    Route::post('/login', 'UserCtrl@login');

    Route::middleware('auth:api') -> group(function () {
        Route::post('/cektoken', 'UserCtrl@cektoken');
        Route::get('/getuser', 'UserCtrl@getuser');
        Route::post('/updateuser', 'UserCtrl@updateuser');
        Route::post('/gantipwduser', 'UserCtrl@gantipwduser');
        Route::post('/picuser', 'UserCtrl@picuser');
        Route::get('/getpicuser', 'UserCtrl@getpicuser');
    }); 
    */

    Route::post('register', 'Auth\AuthController@register');
    Route::post('login', 'Auth\AuthController@login');
    Route::post('recover', 'Auth\AuthController@recover');

    //Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
    //Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
    //Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');

    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('test', function(){
            return response()->json(['foo'=>'bar']);
        });
    });

});





