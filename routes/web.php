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

/**
* Auth Routes
*/
Auth::routes();
Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', function() {
  Auth::logout();
  return redirect('/');
});

/**
* Account
*/
Route::prefix('account')->group(function () {
  Route::get('/', 'AccountController@index')->name('account.edit');
  Route::put('update-account-details/{master_id}', 'AccountController@updateAccountDetails')->name('account.update.details');

  Route::get('change-password', 'AccountController@changePassword')->name('account.change.password');
  Route::put('update-password/{master_id}', 'AccountController@updatePassword')->name('account.update.password');

  Route::get('basic-setup', 'AccountController@basicSetup')->name('account.basic.setup');
  Route::put('update-basic-setup/{master_id}', 'AccountController@updateBasicSetup')->name('account.update.basic_setup');

  Route::get('email-settings', 'AccountController@emailSettings')->name('account.email.settings');
  Route::get('settings', 'AccountController@settings')->name('account.settings');
  Route::put('update-settings/{master_id}', 'AccountController@updateSettings')->name('account.update.settings');
});

/**
* Dashboard
*/
Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::get('/', 'HomeController@index')->name('dashboard');

/**
* View User List
*/
Route::get('{type}/user', 'UserController@user')->name('user');
Route::get('{type}/{id}/user-settings', 'UserController@userSettings')->name('user.settings');
Route::get('{type}/{id}/company/add-user', 'UserController@addCompanyUser')->name('company.add.user');
Route::post('get-state', 'UserController@getStates')->name('getStates');
Route::post('get-cities', 'UserController@getCities')->name('getCities');
Route::get('{type}/add-user/{user_id?}', 'UserController@index')->name('add-user');
Route::post('add-user-create', 'UserController@store')->name('add-user.create');
Route::post('add-maps', 'UserController@addMaps')->name('add.maps');
Route::post('check-user-email', 'UserController@checkUserEmail')->name('check-user-email');

/**
* Reports
*/
Route::prefix('report')->group(function () {
  
  Route::get('travel', 'ReportController@travel')->name('report.travel');
  Route::post('travel', 'ReportController@travelModify')->name('travel.report.modify');
  Route::get('trip', 'ReportController@trip')->name('trip-report');
  Route::post('trip', 'ReportController@travelModify')->name('trip.report.modify');

});
Route::get('admin-travel-history', 'HomeController@travelHistory')->name('travel-history');


/**
* Alerts
*/
Route::prefix('alert')->group(function() {
  Route::get('/', 'AlertController@index')->name('alerts.view');
  Route::get('create', 'AlertController@create')->name('alert.create');
  Route::post('store', 'AlertController@store')->name('alert.store');
  Route::post('delete', 'AlertController@delete')->name('alert.delete');
  Route::post('change-status', 'AlertController@changeStatus')->name('alert.change.status');
});
/**
* Testing Route
*/
Route::get('data', 'HomeController@getDistance');

/**
* Tracking
*/
Route::prefix('maps')->group(function () {
  Route::get('/', 'MapController@maps');
  Route::get('track/{imei}', 'MapController@track')->name('track');
  Route::get('playback/{id?}', 'MapController@playbacks')->name('map.playback');
  Route::post('playbackByVehicle', 'MapController@playbackDataByVehicle')->name('playbackByVehicle');
  Route::post('getLocation', 'MapController@getLocation');
  Route::get('tracking', 'MapController@maps');
});

/**
* Object
*/
Route::prefix('object')->group(function () {
  Route::get('/', 'ObjectController@index')->name('objects.view');
  Route::get('create', 'ObjectController@create')->name('object.create');
  Route::post('store', 'ObjectController@store')->name('object.store');
  Route::get('{id}/edit', 'ObjectController@edit')->name('object.edit');
  Route::post('update', 'ObjectController@update')->name('object.update');
  Route::get('bulk/upload', 'ObjectController@bulkUpload')->name('object.bulk.view');
  Route::post('bulk/store', 'ObjectController@bulkUploadStore')->name('object.bulk.store');
  Route::get('assign-vehicles', 'ObjectController@assign')->name('object.assign.view');
  Route::post('assign-vehicles', 'ObjectController@assignObjects')->name('objects.assign');
  Route::post('assign-vehicles-save', 'ObjectController@saveAssignableVehicle')->name('objects.assign.save');
});

/**
* Rules & Branch
*/
Route::post('create-user-rule', 'UserController@createUserRule')->name('save.user.rule');
Route::post('save-branch', 'UserController@saveBranch')->name('save.branch');
