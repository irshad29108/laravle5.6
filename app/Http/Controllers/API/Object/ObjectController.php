<?php
namespace App\Http\Controllers\API\Object;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use Hash;
use Session;
use App\Models\{BranchMaster,ObjectMaster,Geofence,poi,Alert,DeviceMaster,UserMaster,OtpVerification,DeviceUserDocument, User};
use DB;
use Validator;
use App\Helpers\Helper as Helper;
use Carbon\Carbon;
use File;

class ObjectController extends Controller {


	public function getAllObject(Request $request){

		$response['code'] = 100;
	 	$response['status'] = 'fail';

	    try{

	    	$Data = ObjectMaster::all();
	    	$response['data'] = $Data;
	    	$response['message'] = 'success';
		    $response['status'] = 'success';
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;
	}


	public function checkSerialNumber(Request $request){

		$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'serial_number' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }

	    try{
	    	$checkDeviceId = Helper::checkDeviceInStock($request->serial_number);

	    	if($checkDeviceId['data']['status_code'] == 200){
		    	$response['message'] = 'Success: device found';
			    $response['code'] = 200;
			    $response['status'] = 'success';
	    	}else{
	    		$response['message'] = 'Error: Device Serial Number are not valid';
	    	}
		   
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;
	}


	

	 public function CreateObject(Request $request){

	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'mobile_number' => 'required',
			'email' => 'required|email|unique:users',
			'serial_number' => 'required',
			'vehicle_number' => 'required',
			//'serial_number' => 'required|unique:device_masters,imei,id,deleted_at,NULL',
			//'vehicle_number' => 'required|unique:vehicle_number,NULL,id,deleted_at,NULL',

        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }

     
		$checkDeviceId = Helper::checkDeviceInStock($request->serial_number);


    	if($checkDeviceId['data']['status_code'] != 200){
	    	$response['message'] = 'Error: Device Serial Number are not valid';
	    	return $response;
    	}
    	$sim_number = $checkDeviceId['data']['data']['simno'];

    	$checkVehicleNumber = DeviceMaster::where(["registration_number"=>$request->vehicle_number])->where("deleted_at",null)->first();

    	if($checkVehicleNumber){
	    	$response['message'] = 'Error: Device Vehicle Number already Used';
	    	return $response;
    	}


    	$checkimei = DeviceMaster::where(["imei"=>$request->serial_number])->where("deleted_at",null)->first();

    	if($checkimei){
	    	$response['message'] = 'Error: Device Serial Number already Used';
	    	return $response;
    	}




	  	try{

	  		$otpData =[
	  			'mobile_number'=>$request->mobile_number,
	  			'email_id'=>$request->email,
	  			'otp_type'=>'1',
	  			'signupData'=>[
	  				'serial_number'=>$request->mobile_number,
	  				'vehicle_number'=>$request->vehicle_number,
	  				'sim_number'=>$sim_number,
	  			],
	  			
	  		];

			$otpObject = new OtpVerification;
			$otpObject->email_id = $otpData['email_id'];
			$otpObject->mobile_number = $otpData['mobile_number'];
			$otpObject->type = $otpData['otp_type']; //($otp_type=='password')?'password':'otp';
			$otpObject->signup_data = isset($otpData['signupData'])?serialize($otpData['signupData']):''; 

			if($otpObject->save()){
			 	$response['message'] = 'Success send to Password generated screen';
	    		$response['code'] = 200;
	    		$response['status'] = 'success';
	    		$response['data'] = ['mobile_number'=>$request->mobile_number,
	  			'email_id'=>$request->email];
	    	}

	  		/*$otpResponse = Helper::otpSend($otpData);
	    	if($otpResponse['code'] == 200){
	    		$response['message'] = 'success:';
	    		$response['code'] = 200;
	    		$response['status'] = 'success';
	    		$response['data'] = ['mobile_number'=>$request->mobile_number,
	  			'email_id'=>$request->email];
	    	}
*/
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 /*public function resendObjectCreateOtpVerification(Request $request){

	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'mobile_number' => 'required',
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }
        
	    try{	

	    	$checkDevice = ObjectMaster::where(["company_id"=>$request->user_id])->first();

	    	if($checkDevice){
		    	$otpResponse = Helper::otpSend($request->mobile_number,$request->user_id);
		    	if($otpResponse['code'] == 200){
		    		$response['message'] = 'success: OTP Send Successfully';
		    		$response['code'] = 200;
		    		$response['status'] = 'success';
		    	}
		    }else{
		    	$response['message'] = 'Error: You are not registered User';
		    }

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }*/



	 public function objectOtpVerification(Request $request){

	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'otp' => 'required',
			'email' => 'required|email',
			'mobile_number' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }
        
	    try{

	    $checkOtp = OtpVerification::where(["email_id"=>$request->email,"otp"=>$request->otp,"mobile_number"=>$request->mobile_number])->first();

    	if($checkOtp){
    		
    		$expired_time = strtotime($checkOtp->updated_at)+UserMaster::OTP_EXPIRED_TIME;

    		$current_time = strtotime(Carbon::now()->toDateTimeString());

    		if($checkOtp->status == '0' and ($current_time - $expired_time) < 0){
    			
    			$signupData = unserialize($checkOtp->signup_data);

				DB::beginTransaction();

				$password_random = $checkOtp->generated_password;//str_random(8);
				$name_random = explode('@',$request->email)[0];//'IAC'.Str::random(8);

				$user = new User;
				$user->name = $name_random;
				$user->email = $request->email;
				$user->password = $password_random;

				if($user->save()){

					$userMaster = new UserMaster;
					$userMaster->user_id = $user->id;
					$userMaster->role_id = UserMaster::RESELLER_ROLE_ID;
					$userMaster->mobile_number =$request->mobile_number;
					$userMaster->password =$password_random;
					$userMaster->name = $name_random;
					$userMaster->user_name = $request->email;


			    	$branchMaster = new BranchMaster;
			    	$branchMaster->company_id = $user->id;
			    	$branchMaster->city_id = BranchMaster::DELHI_CITY_ID;


			    	$deviceMaster = new DeviceMaster;
			    	$deviceMaster->mobile_number = $request->mobile_number;
			    	$deviceMaster->sim_number = $signupData['sim_number'];
			    	$deviceMaster->imei = $signupData['serial_number'];
			    	$deviceMaster->registration_number = $signupData['vehicle_number'];
			    	$deviceMaster->status = '0';
			    	$deviceMaster->created_by = $user->id;



			    	if($userMaster->save() && $branchMaster->save() && $deviceMaster->save()){

				    	$object = new ObjectMaster;
				    	$object->reseller_id = $user->id;
				    	$object->company_id = $user->id;
				    	$object->company_branch_id = $branchMaster->id;
				    	$object->device_id = $deviceMaster->id;

				    	if($object->save()){

				    		DB::commit();


							$OtpVerification = OtpVerification::find($checkOtp->id);
							$OtpVerification->status = '1';
							$OtpVerification->save();

							$response['code'] = 200;
							$response['status'] = 'success';
							$response['message'] = 'success';
							$response['data'] = ['user_id'=>$user->id,'reseller_id'=>$object->reseller_id,'company_id'=>$object->company_id,'company_branch_id'=>$object->company_branch_id,'device_id'=>$deviceMaster->id,'registration_number'=>$deviceMaster->registration_number];

						}else{
							DB::rollback();
						}

					}else{
					DB::rollback();
					}
				}else{
					DB::rollback();
				}
			
			}else{
				$response['message'] = 'Error: OTP Expired';
			}

    	}else{
			$response['message'] = 'OTP did not matched or email and mobile number or invalid';
    	}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;


	 }



	 public function kycDocumentUpload(Request $request){

			
			$response['code'] = 100;
			$response['status'] = 'fail';

				$validator = Validator::make($request->all(),[
				'personal_doc_name' => 'required',
				'personal_front_file' => 'required',
				'personal_front_file_type' => 'required',
				'personal_back_file' => 'required',
				'personal_back_file_type' => 'required',
				'vehicle_doc_name' => 'required',
				'vehicle_file' => 'required',
				'vehicle_file_type' => 'required',
				'device_id' => 'required|numeric',
			]);

			if ($validator->fails()) {
			    $response['errors'] = json_encode($validator->errors());
			    $response['message'] = 'Error: Validation Failed!';
			    return $response;
			}

			try{

				$checkDevice = DeviceMaster::where(["id"=>$request->device_id])->first();

				if($checkDevice){
					
					$personal_front_doc_file = Helper::uploadFiles($request->personal_front_file,$request->personal_front_file_type);
					$personal_back_doc_file = Helper::uploadFiles($request->personal_back_file,$request->personal_back_file_type);
					$vehicle_doc_file = Helper::uploadFiles($request->vehicle_file,$request->vehicle_file_type);


					$deviceDocumentPersonal = new DeviceUserDocument;
					$deviceDocumentPersonal->device_id = $request->device_id;
					$deviceDocumentPersonal->document_type = '0';//personall
					$deviceDocumentPersonal->document_name = $request->personal_doc_name;
					$deviceDocumentPersonal->document_file = implode(",",array($personal_front_doc_file,$personal_back_doc_file));
					$save1 = $deviceDocumentPersonal->save();

					$deviceDocument = new DeviceUserDocument;
					$deviceDocument->device_id = $request->device_id;
					$deviceDocument->document_type = '1';//vehicle
					$deviceDocument->document_name = $request->vehicle_doc_name;
					$deviceDocument->document_file = implode(",",array($vehicle_doc_file));
					$save2 = $deviceDocument->save();

					if($save2 OR $save2){

						$response['code'] = 200;
						$response['status'] = 'success';
						$response['message'] = 'success';
						$response['data'] = DeviceUserDocument::where('device_id',$request->device_id)->get()->toArray();
					}


				}else{
					$response['message'] = ' Device not found';
				}

			}catch(\Exception $e){
				$response['message'] = $e->getMessage();
			}

			return $response;
			

	 }



	 public function DeleteVehicleDeviceMaster(Request $request){


	 	$response['code'] = 100;
	 	$response['status'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'device_id' => 'required',
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }

	    try{

	    	$checkDevice = ObjectMaster::where(["company_id"=>$request->user_id])->first();

	    	if($checkDevice){

		    	//---SoftDelete--
		    	$Object = DeviceMaster::find($request->device_id);//->delete();
		    	$Object->deleted_at = now();
		    	$Object->save();

		    	$response['message'] = 'Device Deleted Successfully';
			    $response['code'] = 200;
			    $response['status'] = 'success';

			}else{

				$response['message'] = 'Error : User not found';
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }







	public function UpdateObject(Request $request,$id){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'reseller_id' => 'required',
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'name' => 'required',
			'device_type' => 'required',
			'imei' => 'required',

        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$object = ObjectMaster::find($id);
	    	$object->reseller_id = $request->reseller_id;
	    	$object->company_id =$request->company_id;
	    	$object->company_branch_id = $request->company_branch_id;
	    	$object->name = $request->name;
	    	$object->registration_number = $request->registration_number;
	    	$object->device_type = $request->device_type;
	    	$object->imei = $request->imei;
	    	$object->sim_number = $request->sim_number;
	    	$object->device_timezone = $request->device_timezone;
	    	$object->plate_number = $request->plate_number;
	    	$object->object_type = $request->object_type;
	    	$object->manufacture_date = $request->manufacture_date;
	    	$object->purchase_date = $request->purchase_date;
	    	$object->installation_date = $request->installation_date;
	    	$object->odometer = $request->odometer;

	    	if($user->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $object;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function DeleteObject(Request $request ,$id){

	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{
	    	/* ---SoftDelete--*/
	    	$Object = ObjectMaster::find($id);
	    	$Object->deleted_at = now();
	    	$Object->save();

	    	$response['message'] = 'User Deleted Successfully';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



  /* geofence */


  	public function getAllGeofence(Request $request){

		$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$geofences = Geofences::all();
	    	$response['Data'] = $geofences;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;
	}

	 public function AddGeofence(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'name' => 'required',
			'fence_type' => 'required',
			'tolerance' => 'required'

        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$geofence = new Geofences;
	    	$geofence->company_id = $request->company_id;
	    	$geofence->company_branch_id =$request->company_branch_id;
	    	$geofence->name = $request->name;
	    	$geofence->description = $request->description;
	    	$geofence->fence_type = $request->fence_type;
	    	$geofence->range = $request->range;
	    	$geofence->tolerance = $request->tolerance;

	    	if($geofence->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = Geofences::find($geofence->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function UpdateGeofence(Request $request,$id){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'name' => 'required',
			'fence_type' => 'required',
			'tolerance' => 'required'

        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$geofence =Geofences::find($id);
	    	$geofence->company_id = $request->company_id;
	    	$geofence->company_branch_id =$request->company_branch_id;
	    	$geofence->name = $request->name;
	    	$geofence->description = $request->description;
	    	$geofence->fence_type = $request->fence_type;
	    	$geofence->range = $request->range;
	    	$geofence->tolerance = $request->tolerance;

	    	if($geofence->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $geofence;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function DeleteGeofence(Request $request ,$id){

	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{
	    	/* ---SoftDelete--*/
	    	$Object = Geofences::find($id);
	    	$Object->deleted_at = now();
	    	$Object->save();

	    	$response['message'] = 'Geofences move to trashed successfully';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	/* Pois */


  	public function getAllPoi(Request $request){

		$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$poi = pois::all();
	    	$response['Data'] = $poi;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;
	}

	public function AddPoi(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'place_name' => 'required'

        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$poi = new pois;
	    	$poi->company_id = $request->company_id;
	    	$poi->company_branch_id =$request->company_branch_id;
	    	$poi->place_name = $request->place_name;
	    	$poi->lat_long = $request->lat_long;
	    	$poi->tolerance = $request->tolerance;
	    	$poi->poi_type = $request->poi_type;
	    	$poi->description = $request->description;
	    	$poi->county_id = $request->county_id;
	    	$poi->state_id = $request->state_id;

	    	if($poi->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = pois::find($poi->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function UpdatePoi(Request $request,$id){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'place_name' => 'required',
			'lat_long' => 'required'

        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$poi =pois::find($id);
	    	$poi->company_id = $request->company_id;
	    	$poi->company_branch_id =$request->company_branch_id;
	    	$poi->place_name = $request->place_name;
	    	$poi->lat_long = $request->lat_long;
	    	$poi->tolerance = $request->tolerance;
	    	$poi->poi_type = $request->poi_type;
	    	$poi->description = $request->description;
	    	$poi->county_id = $request->county_id;
	    	$poi->state_id = $request->state_id;
	    	if($geofence->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $poi;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function DeletePoi(Request $request ,$id){

	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{
	    	/* ---SoftDelete--*/
	    	$poi = pois::find($id);
	    	$poi->deleted_at = now();
	    	$poi->save();

	    	$response['message'] = 'Poi move to trashed successfully';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	/* Alerts */

  	public function getAlert(Request $request){

		$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$alerts = Alerts::all();
	    	$response['Data'] = $alerts;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;
	}

	public function AddAlert(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'vehicle_id' => 'required'

        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$alert = new Alerts;
	    	$alert->company_id = $request->company_id;
	    	$alert->company_branch_id =$request->company_branch_id;
	    	$alert->vehicle_id = $request->vehicle_id;
	    	$alert->alert_name = $request->alert_name;
	    	$alert->alert_type = $request->alert_type;
	    	$alert->alert_operator = $request->alert_operator;
	    	$alert->alertValue = $request->alertValue;
	    	$alert->alert_message_text = $request->alert_message_text;
	    	$alert->is_sms = $request->is_sms;
	    	$alert->is_email = $request->is_email;
	    	$alert->is_notification = $request->is_notification;
	    	$alert->mobile_number = $request->mobile_number;
	    	$alert->email_id = $request->email_id;
	    	$alert->user_id = $request->user_id;
	    	$alert->notification_dound=  $request->notification_dound;

	    	if($alert->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = Alerts::find($alert->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function UpdateAlert(Request $request,$id){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'company_id' => 'required',
			'company_branch_id' => 'required',
			'vehicle_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$alert =Alerts::find($id);
	    	$alert->company_id = $request->company_id;
	    	$alert->company_branch_id =$request->company_branch_id;
	    	$alert->vehicle_id = $request->vehicle_id;
	    	$alert->alert_name = $request->alert_name;
	    	$alert->alert_type = $request->alert_type;
	    	$alert->alert_operator = $request->alert_operator;
	    	$alert->alertValue = $request->alertValue;
	    	$alert->alert_message_text = $request->alert_message_text;
	    	$alert->is_sms = $request->is_sms;
	    	$alert->is_email = $request->is_email;
	    	$alert->is_notification = $request->is_notification;
	    	$alert->mobile_number = $request->mobile_number;
	    	$alert->email_id = $request->email_id;
	    	$alert->user_id = $request->user_id;
	    	$alert->notification_dound=  $request->notification_dound;

	    	if($alert->save()){

				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $alert;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function DeleteAlert(Request $request ,$id){

	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{
	    	/* ---SoftDelete--*/
	    	$alert = Alerts::find($id);
	    	$alert->deleted_at = now();
	    	$alert->save();

	    	$response['message'] = 'Alert move to trashed successfully';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }

}