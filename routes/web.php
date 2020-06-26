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
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('layouts.master');
    });
});
Route::get('vendor/registration', 'VendorRegistrationController@register')->name('vendor.register');
Route::post('vendor/register', 'VendorRegistrationController@store')->name('vendor.store');


Auth::routes();
