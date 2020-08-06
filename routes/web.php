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

Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
// -----------Admin Route Start------------------------------
Route::resource('categories', 'CategoryController');
Route::resource('requirements', 'RequirementController');
Route::resource('vendors', 'VendorController');
Route::resource('profiles', 'ProfileController');

Route::post('addComment', 'RequirementController@addComment');
Route::post('updateStatus', 'RequirementController@updateStatus');
Route::post('updateRequirementStatus', 'RequirementController@updateRequirementStatus')->name('update.requirement.status');
Route::get('showQuotation/{requirementId}/{vendorAssignId}', 'RequirementController@showQuotation');
Route::post('uploadPaymentReceipt', 'RequirementController@uploadPaymentReceipt')->name('upload.payment.receipt');
Route::get('reviews/index', 'ReviewRatingController@index')->name('reviews.index');
Route::post('reviews/rating', 'ReviewRatingController@save')->name('save.review.rating');
Route::get('transaction/index', 'TransactionController@index')->name('admin.transaction.index');

Route::get('reports/index', 'ReportController@index')->name('reports.index');

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

Route::group(['namespace' => 'Vendor','prefix' => 'vendor','middleware' => ['auth']],
	function(){
	Route::get('dashboard', function () {
	        return view('layouts.master');
	 });
Route::get('dashboard', 'DashboardController@index')->name('vendor.dashboard');
Route::resource('accounts', 'AccountController');
Route::post('accounts/company/update/{id}', 'AccountController@updateCompanyDetail')->name('accounts.company.update');
Route::post('accounts/document/store', 'AccountController@documentStore')->name('accounts.document.store');
Route::post('accounts/contact-details/store', 'AccountController@supportContactStore')->name('accounts.contact.detail.store');
Route::post('accounts/bank-details/store', 'AccountController@bankDetailStore')->name('accounts.bank.detail.store');
Route::post('accounts/update/{id}', 'AccountController@updateVendorDetail')->name('accounts.vendor.update');
Route::get('past/requirements', 'PastRequirementController@index')->name('past.requirement.index');
Route::get('past/requirements/show/{id}', 'PastRequirementController@show')->name('past.requirement.show');
Route::get('new/requirements', 'NewRequirementController@index')->name('new.requirement.index');
Route::get('new/requirements/show/{id}', 'NewRequirementController@show')->name('new.requirement.show');
Route::get('new/requirements/edit/{id}', 'NewRequirementController@edit')->name('new.requirement.edit');
Route::post('new/requirements/update/{id}','NewRequirementController@update')->name('new.requirement.update');
Route::get('download/document/{filename}','NewRequirementController@getDocumentDownload')->name('download.document');
Route::get('showQuotationDetail/{id}/{assign_vendor_id}', 'NewRequirementController@showQuotationDetail')->name('quotation.show');
Route::get('reviews/index', 'ReviewRatingController@index')->name('vendor.reviews.index');
Route::get('transaction/index', 'TransactionController@index')->name('transaction.index');
Route::get('download/payment/{filename}','TransactionController@getPaymentFIleDownload')->name('download.payment.receipt');
Route::get('review/rating/show/{id}', 'ReviewRatingController@show')->name('review.rating.show');

});

Route::group(['namespace' => 'Admin','prefix' => 'vendor','middleware' => ['auth']],
	function(){
		Route::resource('notifications', 'NotificationController');
		Route::get('notification/markAsRead/{id}','NotificationController@markAsRead')->name('notification.markAsRead');
	});




