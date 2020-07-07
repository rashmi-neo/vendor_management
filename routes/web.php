<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('vendor/registration', function () {
    return view('vendor.registration');
});

/**
* Routes for dashboard.
* @author Bharti<bharati.tadvi@neosofttech.com>
*
* @return void
*/
Auth::routes();
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth'] ], function () {
	Route::get('dashboard', function () {
	        return view('layouts.master');
	 });
// -----------Admin Route Start------------------------------
Route::resource('categories', 'CategoryController');
Route::resource('requirements', 'RequirementController');
Route::resource('vendors', 'VendorController');


/**
* Routes for Notifications.
* @author Sukanya<sukanya.dharangaonkar@neosofttech.com>
*
* @return void
*/
Route::resource('notification', 'NotificationController');
Route::get('notification/markAsRead/{id}','NotificationController@markAsRead')->name('notification.markAsRead');

Route::get('requirements/vendors/{id}','RequirementController@getVendorDetails');
// --------------Admin Route End----------------------------
});
Route::get('vendor/registration', 'VendorController@register')->name('vendor.register');
Route::post('vendor/register', 'VendorController@store')->name('vendor.store');

Route::group(['prefix' => 'vendor','middleware' => ['auth']],
	function(){
	Route::get('dashboard', function () {
	        return view('layouts.master');
	 });
});




