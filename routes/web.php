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
    return view('home');
})->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('register', 'Auth\RegisterController@create')->name('register');
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifytoken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('verifyDone', 'Auth\RegisterController@verifyDone')->name('verifyDone');

Route::get('noaccess', function () {
    return view('noaccess');
})->name('noaccess');

Route::group(['middleware' => ['web', 'auth', 'cekrole']], function () {
    Route::get('profile', 'ProfileCtrl@profile')->name('profile');
    Route::post('updateavatar', 'ProfileCtrl@update_avatar');
    Route::post('updateprofile', 'ProfileCtrl@update_profile');

    /** SETTING */
    Route::get('userlist', 'Auth\settingCtrl@userlist')->name('userlist');
    Route::get('userlist/{jenis}/{email}', 'Auth\settingCtrl@deactivateuser')->name('deactivateuser');
    Route::get('userrole/{email}/{userid}', 'Auth\settingCtrl@userrole')->name('userrole');
    Route::get('usermodule', 'Auth\settingCtrl@usermodule')->name('usermodule');
    Route::get('addmodule/{email}/{id}/{userid}', 'Auth\settingCtrl@addmodule')->name('addmodule');
    Route::get('removemodule/{email}/{userid}/{roleid}', 'Auth\settingCtrl@removemodule')->name('removemodule');

    /* PORTAL */
    Route::get('portal', 'portalctrl@index')->name('portal');

});