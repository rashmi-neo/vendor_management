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


/**
* Routes for dashboard.
* @author Bharti<bharati.tadvi@neosofttech.com>
* 
* @return void
*/
Auth::routes();
Route::middleware('auth')->group(function () {
	Route::get('dashboard', function () {
	        return view('layouts.master');
	 });
// -----------Admin Route Start------------------------------
Route::resource('categories', 'Admin\CategoryController');
// --------------Admin Route End----------------------------

});


