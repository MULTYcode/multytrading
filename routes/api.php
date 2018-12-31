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

 Route::group(
    [           
        'namespace' => 'Api',
        'prefix' => 'Api',
    ], function(){

        Route::post('/newtoken', 'Api\UserController@newtoken')->middleware('auth:api');
}); 

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

Route::middleware('auth:api')->group(function(){

    Route::get('/getuser', 'UserController@getuser');
    Route::post('/updateuser', 'UserController@updateuser');
    Route::post('/gantipwduser', 'UserController@gantipwduser');
    Route::post('/picuser', 'UserController@picuser');
    Route::get('/getpicuser', 'UserController@getpicuser');
});



