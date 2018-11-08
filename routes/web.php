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

Route::get('noaccess', function () {
    return view('noaccess');
})->name('noaccess');

Route::group(['middleware' => ['web', 'auth', 'cekrole']], function () {
    Route::get('dashboard', 'DashboardwebCtrl@dashboard')->name('dashboard');
    //Route::get('store', 'StoreCtrl@index')->name('store');

    Route::get('profile', 'ProfileCtrl@profile')->name('profile');
    Route::post('updateavatar', 'ProfileCtrl@update_avatar');
    Route::post('updateprofile', 'ProfileCtrl@update_profile');

    Route::get('cryear', 'cryearCtrl@cryear')->name('cryear');
    Route::get('pcsyear', 'pcsyearCtrl@pcsyear')->name('pcsyear');
    Route::get('revenueyear', 'revenueyearCtrl@revenueyear')->name('revenueyear');

    Route::get('member', 'memberCtrl@member')->name('member');
    Route::get('membertrans/{bulan}', 'memberCtrl@trans')->name('membertrans');

    Route::post('catalogview', 'catalogCtrl@catalogview')->name('catalogview');
    Route::get('catalog', 'catalogCtrl@catalog');
     //Route::post('catalog', 'catalogCtrl@getitemAJAX');
    Route::post('catalog', 'catalogCtrl@getitem');
    Route::get('catalog/{id}', 'catalogCtrl@getitemposisi')->name("catalogstore");

    // * SALES */
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
    Route::get('salesbystoreview/{jenis}/{brand}/{datefrom}/{dateto}', 'salesCtrl@getstore')->name('getstore');

    Route::get('salesbyclass', 'salesCtrl@salesbyclass');
    Route::post('salesbyclassview', 'salesCtrl@getsalesbyclass');

    Route::get('salesbycategory', 'salesCtrl@salesbycategory');
    Route::get('salesbycategory/{category}', 'salesCtrl@subcategory')->name('subcategory');
    Route::get('salesbycategory/{category}/{item}', 'salesCtrl@subcategoryitem')->name('subcategoryitem');

    Route::get('salesbychannel', 'salesCtrl@salesbychannel')->name('salesbychannel');
    Route::post('salesbychannelview', 'salesCtrl@getsalesbychannel')->name('getsalesbychannel');

    Route::get('salesachievement', 'salesCtrl@salesachievement');

     /* WAREHOUSE */
    Route::get('warehouse', 'warehouseCtrl@index')->name('warehouse');
    Route::post('mutasiperiodeview', 'warehouseCtrl@mutasiperiodeview');
    Route::get('mutasistore', 'warehouseCtrl@mutasistore')->name('mutasistore');
    Route::post('mutasistoreview', 'warehouseCtrl@mutasistoreview')->name('mutasistoreview');
    Route::get('mutasibrand', 'warehouseCtrl@mutasibrand')->name('mutasibrand');
    Route::post('mutasibrandview', 'warehouseCtrl@mutasibrandview')->name('mutasibrandview');
    Route::get('mutasiclass', 'warehouseCtrl@mutasiclass')->name('mutasiclass');
    Route::post('mutasiclassview', 'warehouseCtrl@mutasiclassview')->name('mutasiclassview');

     /* INVENTORY */
    Route::get('grn2sls', 'invCtrl@index')->name('grn2sls');
    Route::post('grn2slsview', 'invCtrl@grn2slsview')->name('grn2slsview');
    Route::get('grn2slsviewgrn/{barcode}', 'invCtrl@grn2slsview_grn')->name('grn2slsviewgrn');
    Route::get('grn2slsviewmutasi/{barcode}', 'invCtrl@grn2slsview_mutasi')->name('grn2slsviewmutasi');
    Route::get('grn2slsviewsales/{barcode}', 'invCtrl@grn2slsview_sales')->name('grn2slsviewsales');

     /* CRM */
    Route::get('membertrans', 'memberCtrl@membertrans')->name('membertrans');
    Route::post('membertransview', 'memberCtrl@membertransview')->name('membertransview');
    Route::get('membertransview/{idcust}', 'memberCtrl@membertransdetail')->name('membertransdetail');

    /** SETTING */
    Route::get('userlist', 'Auth\settingCtrl@userlist')->name('userlist');
    Route::get('userlist/{jenis}/{email}', 'Auth\settingCtrl@deactivateuser')->name('deactivateuser');
    Route::get('userrole/{email}/{userid}', 'Auth\settingCtrl@userrole')->name('userrole');
    Route::get('usermodule', 'Auth\settingCtrl@usermodule')->name('usermodule');
    Route::get('addmodule/{email}/{id}/{userid}', 'Auth\settingCtrl@addmodule')->name('addmodule');
    Route::get('removemodule/{email}/{userid}/{roleid}', 'Auth\settingCtrl@removemodule')->name('removemodule');
});