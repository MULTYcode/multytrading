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

Route::namespace('Api')->group(function () {

    Route::post('/register', 'UserCtrl@register');
    Route::post('/login', 'UserCtrl@login');    
    Route::get('/ambil', 'Api\UserCtrl@UserCtrl');

    Route::middleware('auth:api')->group(function(){
        Route::post('/cektoken', 'UserCtrl@cektoken');
        Route::get('/getuser', 'UserCtrl@getuser');
        Route::post('/updateuser', 'UserCtrl@updateuser');
        Route::post('/gantipwduser', 'UserCtrl@gantipwduser');
        Route::post('/picuser', 'UserCtrl@picuser');
        Route::get('/getpicuser', 'UserCtrl@getpicuser'); 
    });          

});



