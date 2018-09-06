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

//Route::get('register', 'Auth\RegisterController@create')->name('register');
Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');
Route::get('verify/{email}/{verifytoken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('verifyDone', 'Auth\RegisterController@verifyDone')->name('verifyDone');

Route::middleware('auth')->group(function () {
  
    Route::get('dashboard', 'DashboardwebCtrl@index')->name('dashboard');

    Route::get('store', 'StoreCtrl@index')->name('store');

    Route::get('profile', 'ProfileCtrl@index')->name('profile');
    Route::post('updateavatar', 'ProfileCtrl@update_avatar');
    Route::post('updateprofile', 'ProfileCtrl@update_profile');

    Route::get('cryear', 'cryearCtrl@index')->name('cryear');
    Route::get('pcsyear', 'pcsyearCtrl@index')->name('pcsyear');
    Route::get('revenueyear', 'revenueyearCtrl@index')->name('revenueyear');

    Route::get('member', 'memberCtrl@index')->name('member');
    Route::get('membertrans/{bulan}', 'memberCtrl@trans')->name('membertrans');

    Route::get('catalog', 'catalogCtrl@index')->name('catalog');
    //Route::post('catalog', 'catalogCtrl@getitemAJAX');
    Route::post('catalog', 'catalogCtrl@getitem');
    Route::get('catalog/{id}', 'catalogCtrl@getitemposisi')->name("catalogstore");

    /* SALES */
    Route::get('sales', 'salesCtrl@index')->name('sales');

    //Route::get('salesfind', 'salesCtrl@sales');
    //Route::post('salesfindview', 'salesCtrl@salesfindview');

    Route::get('salesperiode', 'salesCtrl@salesperiode');
    Route::post('salesperiodeview', 'salesCtrl@salesperiodeview');

    Route::get('salesbybrand', 'salesCtrl@salesbybrand');
    Route::post('salesbybrandview', 'salesCtrl@salesbybrandview');
    Route::get('salesbybrandview/{store}/{datefrom}/{dateto}', 'salesCtrl@getstorebrand')->name('getstorebrand');
    Route::get('salesbybrandview/{store}/{brand}/{datefrom}/{dateto}', 'salesCtrl@getsalesitems')->name('getsalesitems');

    Route::get('salesbystore', 'salesCtrl@salesbystore');
    Route::post('salesbystoreview', 'salesCtrl@salesbystoreview');
    Route::get('salesbystoreview/{brand}/{datefrom}/{dateto}', 'salesCtrl@getstore')->name('getstore');

    Route::get('salesbyclass', 'salesCtrl@salesbyclass');
    Route::post('salesbyclassview', 'salesCtrl@getsalesbyclass');

    Route::get('salesbycategory', 'salesCtrl@salesbycategory');

    Route::get('salesachievement', 'salesCtrl@salesachievement');

    /* WAREHOUSE */
    Route::get('warehouse', 'warehouseCtrl@index')->name('warehouse');
    Route::post('mutasiperiodeview', 'warehouseCtrl@mutasiperiodeview');
}); 