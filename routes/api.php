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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('API')->group(function(){
	
	/*Route::post('register', 'UserController@register');
	Route::post('login', 'UserController@login');*/


	Route::post('v1/user/login', 'User\UserController@UserLogin');

	Route::get('v1/object/checkDeviceSerialNumber', 'Object\ObjectController@checkSerialNumber');
	Route::get('v1/object/get', 'Object\ObjectController@getAllObject');
	Route::post('v1/object/create', 'Object\ObjectController@AddObject');
	Route::post('v1/object/otpVerification', 'Object\ObjectController@otpVerification');
	Route::post('v1/object/passwordGenerate', 'Object\ObjectController@passwordGenerate');
	Route::post('v1/object/forgotPassword', 'Object\ObjectController@forgotPassword');
	Route::post('v1/object/kycDocument', 'Object\ObjectController@kycDocumentUpload');



	/*User Module*/ 
		/*Route::post('v1/user/login', 'User\UserController@UserLogin');
		Route::post('v1/user/create/myaccout', 'User\UserController@AddMyaccount');
		Route::post('v1/user/create/rule', 'User\UserController@AddRules');
		Route::post('v1/user/create/setting', 'User\UserController@AddSetting');
		Route::post('v1/user/create/data-access', 'User\UserController@AddDataAcess');
		Route::post('v1/user/create/map-setting', 'User\UserController@AddMapSetting');
		Route::post('v1/user/create/sms-setting', 'User\UserController@AddSmsSetting');
		Route::post('v1/user/create/email-setting', 'User\UserController@AddEmailSetting');

		Route::get('v1/user/get/rules', 'User\UserController@Getrules');
		Route::get('v1/user/get/map-setting', 'User\UserController@GetMapSetting');

		Route::post('v1/user/accountUpdate/{id}', 'User\UserController@UpdateAccount');
		Route::post('v1/user/settingUpdate/{id}', 'User\UserController@UpdateSetting');
		Route::post('v1/user/dataAccess/{id}', 'User\UserController@UpdateDataAccess');
		Route::post('v1/user/email/{id}', 'User\UserController@UpdateEmail');
		Route::post('v1/user/sms/{id}', 'User\UserController@UpdateSms');

		Route::delete('v1/user/delete/{id}', 'User\UserController@DeleteUser');


		Route::get('v1/user/get', 'User\UserController@getAllUsers');
		Route::get('v1/user/byuserType', 'User\UserController@getAllUsersWithType');
		Route::get('v1/user/byTypeParentid', 'User\UserController@getAllUsersWithTypeParent');*/
	

	/* Device Module */
		/*Route::get('v1/device/topUpdateData', 'Common\MasterController@getDeviceTopUpdateData');
		Route::get('v1/device/healthTopUpdateData','API\Common\MasterController@getDevicehealthmonitoringTopUpdateData');*/

	/* Object Module */
		/*Route::get('v1/object/get', 'Object\ObjectController@getAllObject');
		Route::post('v1/object/create', 'Object\ObjectController@AddObject');
		Route::post('v1/object/update/{id}', 'Object\ObjectController@UpdateObject');
		Route::delete('v1/object/delete/{id}', 'Object\ObjectController@DeleteObject');*/

	/* Common Module */
		/*Route::get('v1/get/userType', 'Common\MasterController@getUsersType');
		Route::get('v1/get/country', 'Common\MasterController@getCountry');
		Route::get('v1/get/state', 'Common\MasterController@getState');
		Route::get('v1/get/city', 'Common\MasterController@getCity');*/


	/* Geofence API */
		/*Route::get('v1/geofences/get', 'Object\ObjectController@getAllGeofence');
		Route::post('v1/geofences/create', 'Object\ObjectController@AddGeofence');
		Route::post('v1/geofences/update/{id}', 'Object\ObjectController@UpdateGeofence');
		Route::delete('v1/geofences/delete/{id}', 'Object\ObjectController@DeleteGeofence');*/


	/* Pois API */
		/*Route::get('v1/pois/get', 'Object\ObjectController@getAllPoi');
		Route::post('v1/pois/create', 'Object\ObjectController@AddPoi');
		Route::post('v1/pois/update/{id}', 'Object\ObjectController@UpdatePoi');
		Route::delete('v1/pois/delete/{id}', 'Object\ObjectController@DeletePoi');*/


	/*Alert api */
		/*Route::get('v1/alert/get', 'Object\ObjectController@getAllAlert');
		Route::post('v1/alert/create', 'Object\ObjectController@AddAlert');
		Route::post('v1/alert/update/{id}', 'Object\ObjectController@UpdateAlert');
		Route::delete('v1/alert/delete/{id}', 'Object\ObjectController@DeleteAlert');*/
});


