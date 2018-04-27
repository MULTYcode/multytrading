<?php

use App\dt_routes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    $daftarmenu = dt_routes::all();
    return view('home', ['daftarmenu' => $daftarmenu]);
});

Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifytoken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('verifyDone','Auth\RegisterController@verifyDone')->name('verifyDone');
