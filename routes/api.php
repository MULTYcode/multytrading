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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware('auth:api')->group(function(){
    // Register, Login, Logout
    //Route::get('/register', 'API\Auth\RegisterController@create')->name('register');
    //Route::get('/register', 'Auth\RegisterController@create')->name('register');
//}); 

//Route::get('/register', 'API\Auth\RegisterController@register')->name('register');

Route::post('/register', 'UserController@register')->name('register');
Route::post('/login', 'UserController@login')->name('login');

Route::middleware('auth:api')->group(function(){
    Route::get('/getuser', 'UserController@getuser')->name('getuser');
    Route::post('/updateuser', 'UserController@updateuser')->name('updateuser');
    Route::post('/gantipwduser', 'UserController@gantipwduser')->name('gantipwduser');
    Route::post('/picuser', 'UserController@picuser')->name('picuser');
    Route::get('/getpicuser', 'UserController@getpicuser')->name('getpicuser');
}); 

// DASHBOARD
Route::middleware('auth:api')->group(function(){
    Route::post('/member', 'DashboardCtrl@jmlMemberToko')->name('member');
    Route::post('/store', 'DashboardCtrl@listToko')->name('store');

    Route::post('/todayrevenue', 'DashboardCtrl@todayrevenue')->name('todayrevenue');
    Route::post('/todayrevenuestore', 'DashboardCtrl@todayrevenuestore')->name('todayrevenuestore');
    Route::post('/todayrevenuemonth', 'DashboardCtrl@todayrevenuemonth')->name('todayrevenuemonth');
    Route::post('/todayrevenueqty', 'DashboardCtrl@todayrevenueqty')->name('todayrevenueqty');
    Route::post('/todayrevenuestoremonth', 'DashboardCtrl@todayrevenuestoremonth')->name('todayrevenuestoremonth');

    Route::post('/avgprice', 'DashboardCtrl@avgprice')->name('avgprice');
    Route::post('/avgpricegroup', 'DashboardCtrl@avgpricegroup')->name('avgpricegroup');
    Route::post('/avgpricedetail', 'DashboardCtrl@avgpricedetail')->name('avgpricedetail');

    Route::post('/avgqty', 'DashboardCtrl@avgqty')->name('avgqty');
    Route::post('/topsold', 'DashboardCtrl@topsold')->name('topsold');
    Route::post('/toprevenue', 'DashboardCtrl@toprevenue')->name('toprevenue');
    Route::post('/toprevenueitem', 'DashboardCtrl@toprevenueitem')->name('toprevenueitem');

    Route::post('/custtrans', 'DashboardCtrl@customerTransaction')->name('customerTransaction');
    Route::post('/crmonth', 'DashboardCtrl@customerCRmonth')->name('customerCRmonth');
    Route::post('/crstore', 'DashboardCtrl@customerCRstore')->name('customerCRstore');
}); 

// INV
Route::middleware('auth:api')->group(function(){
    Route::post('/invitem', 'DashboardCtrl@invitem')->name('invitem');
    Route::post('/inv', 'DashboardCtrl@invperiode')->name('inv');
}); 

Route::middleware('auth:api')->group(function(){
    Route::get('/getdivisi', 'DashboardCtrl@getdivisi')->name('getdivisi');
}); 

// TAMO
Route::post('/tamoregister', 'TamoUserCtrl@register')->name('tamoregister');
Route::post('/tamologin', 'Tamo\TamoUserCtrl@login')->name('tamologin');
Route::middleware('auth:api')->group(function(){
    Route::get('/tamogetuser', 'TamoUserCtrl@getuser')->name('tamogetuser');
    Route::post('/tamoupdateuser', 'TamoUserCtrl@updateuser')->name('tamoupdateuser');
    Route::post('/tamogantipwduser', 'TamoUserCtrl@gantipwduser')->name('tamogantipwduser');
    Route::post('/tamopicuser', 'TamoUserCtrl@picuser')->name('tamopicuser');
    Route::get('/tamogetpicuser', 'TamoUserCtrl@getpicuser')->name('tamogetpicuser');
}); 