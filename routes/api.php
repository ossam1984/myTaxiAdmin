<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});
// Driver
Route::group(['prefix'=>'driver'],function(){
	Route::get("all-near-orders","OrderCtrl@getNearOrders")->middleware('auth:api');
	Route::get("accept-order","OrderCtrl@acceptOrder")->middleware('auth:api');
	Route::get("get-driver-info","UserCtrl@DriverInfo")->middleware('auth:api');
});


// Controllers


	// Register Users
Route::group(['prefix'=>'user'] , function(){
	
	Route::any("register","UserCtrl@create");


	Route::get("note",function(){
			$note = new \App\Helpers\PushNote();
			$note->send();
	});
	Route::any('conformation','UserAppCtrl@conformation');
	// Route::any('register','UserAppCtrl@register');
	Route::any('update-device-token','UserAppCtrl@updateToken');
	// Route::any('make-active','UserAppCtrl@make_active');
	Route::any('active','UserAppCtrl@make_active');
	



});


	// Make Orders
Route::group(['prefix'=>'orders'] , function(){
	Route::get("get-near-orders","OrderCtrl@nearOrders");
	Route::any("change","OrderCtrl@changeOrderSt");
	Route::any('new','OrderCtrl@makeNewOrder');
	Route::any('register','UserAppCtrl@register');
	Route::any('update-device-token','UserAppCtrl@updateToken');
	Route::any('make-active','UserAppCtrl@make_active');
	Route::any('accept-order/{order_id}/{driver_id}','OrderCtrl@acceptOrder');
	Route::any('get-order','OrderCtrl@getOrderById');
	

	// Make Orders
	

});

