<?php

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

Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifytoken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('verifyDone', 'Auth\RegisterController@verifyDone')->name('verifyDone');

Route::middleware('auth')->group(function () {

    Route::get('dashboard', 'DashboardwebCtrl@index')->name('dashboard');

    Route::get('store', 'StoreCtrl@index')->name('store');

    Route::get('profile', 'ProfileCtrl@index')->name('profile');
    Route::post('updateavatar', 'ProfileCtrl@update_avatar');
    Route::post('updateprofile', 'ProfileCtrl@update_profile');

}); 