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


Route::get('/menu', 'viewctrl@index')->name('menu');

