<?php
namespace App\Http\Controllers\API\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\{User, UserMaster,UserRuleSetting,UserSetting,UserDataAccess,UserMapSetting,UserSmsSetting,UserEmailSetting,OtpVerification};
use DB;
use Validator;
use App\Helpers\Helper as Helper;
use Carbon\Carbon;

class UserController extends Controller {


	 public function UserLogin(Request $request){

	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'user_name' => 'required',
			'password' => 'required',
        ]);


        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }
        
	    try{

	    	$userData = User::where(['email'=>$request->user_name])->first();

	    	if($userData){

		    	if(Hash::check($request->input('password'), $userData->password)) {

			    	$response['data'] = ['user_id'=>$userData->id,'email'=>$userData->email];
			    	$response['message'] = 'LoggedIn Successfully';
				    $response['code'] = 200;
				    $response['status'] = 'success';
			    }else{
			    	$response['message'] = 'LoggedIn Failed Wrong Credential';
			    	$response['data'] = null;
			    }

			}else{
				$response['message'] = 'LoggedIn Failed Wrong Credential';
		    	$response['data'] = null;
		    }

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;


	 }


	 public function forgotPassword(Request $request){

	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'email' => 'required|email',
			'mobile_number' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }
        
	    try{

	    	$user = User::with(['userMaster' => function($query) use ($request) {
			    $query->where('mobile_number',$request->mobile_number);
			}])->where('email',$request->email)->first();

	    	if($user){
	    		$user = $user->toArray();
		    	if($user['user_master']){

					$response['code'] = 200;
					$response['status'] = 'success';

			  		$otpData =[
			  			'mobile_number'=>$request->mobile_number,
			  			'email_id'=>$request->email,	  			
			  			'otp_type'=>'1',	  			
			  		];

					$otpObject = new OtpVerification;
					$otpObject->email_id = $request->emailr;
					$otpObject->mobile_number = $request->mobile_numbe;
					$otpObject->type = '1';//($otp_type=='password')?'password':'otp';
					
					$otpResponse = Helper::otpSend($otpData);

			    	if($otpResponse['code'] == 200){

			    		$response['message'] = 'success: OTP Send Successfully';
			    		$response['data'] = ['user_id'=>$user['id'],'email'=>$user['email'],'mobile_number'=>$user['user_master']['mobile_number']];

			    	}else{
			    		$response['message'] = 'Success: Could not send message';
			    	}
					
				}else{
					$response['message'] = 'User not found ';
				}
			}else{
				$response['message'] = 'User not found ';
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	  public function resendOtp(Request $request){

	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[
			'email' => 'required|email',
			'mobile_number' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }
        
	    try{

	    	$checkOtp = OtpVerification::where(["email_id"=>$request->email,'status'=>'0',"mobile_number"=>$request->mobile_number])->first();

	    	if($checkOtp){

					$response['code'] = 200;
					$response['status'] = 'success';
			  		$otpData =[
			  			'mobile_number'=>$request->mobile_number,
			  			'email_id'=>$request->email,	  			
			  			'otp_type'=>'1',	  			
			  		];

					$otpResponse = Helper::otpSend($otpData);

			    	if($otpResponse['code'] == 200){

			    		$response['message'] = 'success: OTP Send Successfully';
			    		$response['data'] = ['mobile_number'=>$request->mobile_number,'email_id'=>$request->email];

			    	}else{
			    		$response['message'] = 'Success: Could not send message';
			    	}
					
			}else{
				$response['message'] = 'Record not found';
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	public function forgotPasswordOtpVerification(Request $request){

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
    		
	    		$expired_time = strtotime($checkOtp->created_at)+UserMaster::OTP_EXPIRED_TIME;

	    		$current_time = strtotime(Carbon::now()->toDateTimeString());

	    		if($checkOtp->status == '0' and ($current_time - $expired_time) < 0){


					$OtpVerification = OtpVerification::find($checkOtp->id);
					$OtpVerification->status = '1';
					$OtpVerification->save();

					$response['code'] = 200;
					$response['status'] = 'success';
					$response['message'] = 'success';
					$response['data'] = User::find($checkOtp->user_id);

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




	public function passwordGenerate(Request $request){


	 	$response['code'] = 100;
	 	$response['status'] = 'fail';

	 	$validator = Validator::make($request->all(),[

			'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
			'confirm_password' => 'required|min:6',
			'email' => 'required|email',
			'mobile_number' => 'required',

        ]);

        if ($validator->fails()) {
            $response['errors'] = json_encode($validator->errors());
            $response['message'] = 'Error: Validation Failed!';
            return $response;
        }
        
	    try{

	    	$otpVerification =OtpVerification::where(['email_id'=>$request->email,'mobile_number'=>$request->mobile_number,'status'=>'0'])->orderBy('id','desc')->first();

	    	if($otpVerification){

				$otpData =[
			  			'mobile_number'=>$request->mobile_number,
			  			'email_id'=>$request->email,	  			
			  			'otp_type'=>'1',	  			
			  		];

	    		$otpVerification->generated_password = bcrypt($request->password);
	    		$otpVerification->save();
				$otpResponse = Helper::otpSend($otpData);

		    	if($otpResponse['code'] == 200){
		    		$response['otpMessage'] = 'success: OTP Send Successfully';
		    	}else{
		    		$response['otpMessage'] = 'Success: Could not send otp';
		    	}

				$response['code'] = 200;
				$response['status'] = 'success';
				$response['message'] = 'Password Generated Successfully';
				$response['data'] = ['email'=>$otpVerification->email_id,'mobile_number'=>$otpVerification->mobile_number];

			}else{
				$response['message'] = 'Error : Signup Device Data not found';
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	 public function AddMyaccount(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_name' => 'required|email|unique:users_masters',
			'name' => 'required',
			'password' => 'required',
			'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$user = User::create([
	            'name' => $request->json()->get('name'),
	            'email' => $request->json()->get('user_name'),
	            'password' => Hash::make($request->json()->get('password')),
	            'decrypted_password' => $request->json()->get('password'),
	        ]);

	    if($user->id){

	    	$user = new UserMaster;
	    	$user->user_id = $user->id;
	    	$user->user_type = $request->user_type;
	    	$user->password = bcrypt($request->password);
	    	$user->user_name = $request->user_name;
	    	$user->name = $request->name;
	    	$user->city = $request->city;
	    	$user->photo = $request->photo;
	    	$user->zipcode = $request->zipcode;
	    	$user->full_address = $request->full_address;
	    	$user->contact_number = $request->contact_number;
	    	$user->contact_person = $request->contact_person;
	    	$user->mobile_number = $request->mobile_number;
	    	$user->fax_number = $request->fax_number;
	    	$user->is_disable_object = $request->is_disable_object;
	    	$user->parent_id = $request->parent_id;
	    	$user->timezone = $request->timezone;
	    	$user->date_format = $request->date_format;
	    	$user->time_format = $request->time_format;
	    	$user->user_status = $request->user_status;
	    	$user->deactive_reason = $request->deactive_reason;
	    	$user->is_immobilization = $request->is_immobilization;
	    	$user->is_web_access = $request->is_web_access;
	    	$user->is_mobile_access = $request->is_mobile_access;
	    	$user->specific_imei_list = $request->specific_imei_list;
	    	if($user->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserMaster::find($user->id);
			}
		}else{
			$response['message'] = 'user not created';
		}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function AddRules(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'rule_name' => 'required|unique:users_rule_settings',
			'valid_from' => 'required',
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$Rule = new UserRuleSetting;
	    	$Rule->user_id = $request->user_id;
	    	$Rule->rule_name = $request->rule_name;
	    	$Rule->description = $request->description;
	    	$Rule->valid_from = date('Y-m-d',strtotime($request->valid_from));
	    	$Rule->device_accuracy_tolerance = $request->device_accuracy_tolerance;
	    	$Rule->device_distance_variation_sign = $request->device_distance_variation_sign;
	    	$Rule->device_distance_variation = $request->device_distance_variation;
	    	$Rule->poi_tolerance = $request->poi_tolerance;
	    	$Rule->speed_tolerance = $request->speed_tolerance;
	    	$Rule->inactive_time = $request->inactive_time;
	    	$Rule->stoppage_time = $request->stoppage_time;
	    	$Rule->idle_time = $request->idle_time;
	    	$Rule->show_cluster = $request->show_cluster;
	    	$Rule->startup_screen = $request->startup_screen;

	    	if($Rule->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserRuleSetting::find($Rule->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function Getrules(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$userRules = UserRuleSetting::where('user_id',$request->user_id)->get();
	    	$response['Data'] = $userRules;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function AddSetting(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$Setting = new UserSetting;
	    	$Setting->user_id = $request->user_id;
	    	$Setting->timezone_id = $request->timezone_id;
	    	$Setting->date_formate = $request->date_formate;
	    	$Setting->time_formate = $request->time_formate;
	    	$Setting->status = $request->status;
	    	$Setting->filter_option = $request->filter_option;
	    	$Setting->live_tracking = $request->live_tracking;
	    	$Setting->country_border = $request->country_border;
	    	$Setting->dispute_region = $request->dispute_region;
	    	$Setting->immobilization = $request->immobilization;
	    	$Setting->web_access = $request->is_web_access;
	    	$Setting->mobile_access = $request->mobile_access;

	    	if($Setting->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserSetting::find($Setting->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	 public function AddDataAcess(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$DataAccess = new UserDataAccess;
	    	$DataAccess->user_id = $request->user_id;
	    	$DataAccess->alert_id = $request->alert_id;
	    	$DataAccess->device_id = $request->device_id;
	    	$DataAccess->language_id = $request->language_id;

	    	if($DataAccess->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserDataAccess::find($DataAccess->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	public function AddMapSetting(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$map = new UserMapSetting;
	    	$map->user_id = $request->user_id;
	    	$map->map_id = $request->map_id;
	    	$map->key = $request->key;
	    	$map->map_project_id = $request->map_project_id;
	    	$map->address_map_provider = $request->address_map_provider;
	    	$map->speed_limit_api = $request->speed_limit_api;
	    	$map->default = $request->default;

	    	if($map->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserMapSetting::find($map->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function GetMapSetting(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$userRules = UserMapSetting::where('user_id',$request->user_id)->get();
	    	$response['Data'] = $userRules;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	public function AddSmsSetting(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
			'getway_name' => 'required',
			'getway_url' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$sms = new UserSmsSetting;
	    	$sms->user_id = $request->user_id;
	    	$sms->getway_name = $request->getway_name;
	    	$sms->getway_url = $request->getway_url;
	    	if($sms->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserSmsSetting::find($sms->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function AddEmailSetting(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
			'from_email' => 'required',
			'user_name' => 'required',
			'password' => 'required',
			'host' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$email = new UserEmailSetting;
	    	$email->user_id = $request->user_id;
	    	$email->from_email = $request->from_email;
	    	$email->user_name = $request->user_name;
	    	$email->password = $request->password;
	    	$email->host = $request->host;
	    	$email->outgoing_port = $request->outgoing_port;
	    	$email->smtp_authentication = $request->smtp_authentication;
	    	$email->tls_authentication = $request->tls_authentication;

	    	if($email->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = UserEmailSetting::find($email->id);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }




	public function UpdateAccount(Request $request,$id){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_name' => 'required|email|unique:usermaster,id,'.$id,
			'name' => 'required',
			'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$user =UserMaster::find($id);
	    	$user->user_type = $request->user_type;
	    	$user->user_name = $request->user_name;
	    	$user->name = $request->name;
	    	$user->city = $request->city;
	    	$user->photo = $request->photo;
	    	$user->zipcode = $request->zipcode;
	    	$user->full_address = $request->full_address;
	    	$user->contact_number = $request->contact_number;
	    	$user->contact_person = $request->contact_person;
	    	$user->mobile_number = $request->mobile_number;
	    	$user->fax_number = $request->fax_number;
	    	$user->is_disable_object = $request->is_disable_object;
	    	$user->parent_id = $request->parent_id;
	    	$user->timezone = $request->timezone;
	    	$user->date_format = $request->date_format;
	    	$user->time_format = $request->time_format;
	    	$user->user_status = $request->user_status;
	    	$user->deactive_reason = $request->deactive_reason;
	    	$user->is_immobilization = $request->is_immobilization;
	    	$user->is_web_access = $request->is_web_access;
	    	$user->is_mobile_access = $request->is_mobile_access;
	    	$user->specific_imei_list = $request->specific_imei_list;
	    	//$user->updated_by = $request->updated_by;

	    	if($user->save()){
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $user;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	 public function UpdateSetting(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$Setting =UserSetting::where('user_id',$request->user_id);
	    	$Setting->user_id = $request->user_id;
	    	$Setting->timezone_id = $request->timezone_id;
	    	$Setting->date_formate = $request->date_formate;
	    	$Setting->time_formate = $request->time_formate;
	    	$Setting->status = $request->status;
	    	$Setting->filter_option = $request->filter_option;
	    	$Setting->live_tracking = $request->live_tracking;
	    	$Setting->country_border = $request->country_border;
	    	$Setting->dispute_region = $request->dispute_region;
	    	$Setting->immobilization = $request->immobilization;
	    	$Setting->web_access = $request->is_web_access;
	    	$Setting->mobile_access = $request->mobile_access;

	    	if($Setting->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $Setting;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function UpdateDataAccess(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$DataAccess = UserDataAccess::where('user_id',$request->user_id);
	    	$DataAccess->user_id = $request->user_id;
	    	$DataAccess->alert_id = $request->alert_id;
	    	$DataAccess->device_id = $request->device_id;
	    	$DataAccess->language_id = $request->language_id;

	    	if($DataAccess->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $DataAccess;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	 public function UpdateSms(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
			'getway_name' => 'required',
			'getway_url' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$sms = UserSmsSetting::where('user_id',$request->user_id);
	    	$sms->user_id = $request->user_id;
	    	$sms->getway_name = $request->getway_name;
	    	$sms->getway_url = $request->getway_url;
	    	if($sms->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $sms;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function UpdateEmail(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_id' => 'required',
			'from_email' => 'required',
			'user_name' => 'required',
			'password' => 'required',
			'host' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$email =UserEmailSetting::where('user_id',$request->user_id);
	    	$email->user_id = $request->user_id;
	    	$email->from_email = $request->from_email;
	    	$email->user_name = $request->user_name;
	    	$email->password = $request->password;
	    	$email->host = $request->host;
	    	$email->outgoing_port = $request->outgoing_port;
	    	$email->smtp_authentication = $request->smtp_authentication;
	    	$email->tls_authentication = $request->tls_authentication;

	    	if($email->save()){
	    		
				$response['status'] = 200;
				$response['message'] = 'success';
				$response['Data'] = $email;
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }




	public function getUsers(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{


	    	$user = UserMaster::where('user_type',$request->UserType)->get();
	    	$response['Data'] = $user;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	public function DeleteUser(Request $request ,$id){

	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$user = UserMaster::find($id);
	    	$user->deleted_at = now();
	    	$user->save();

	    	$response['message'] = 'User Deleted Successfully';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }



	 public function getAllUsers(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$Users = UserMaster::all();
	    	$response['Data'] = $Users;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function getAllUsersWithType(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_type' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;


	    try{

	    	$Users = UserMaster::where('user_type',$request->UserType);
	    	$response['Data'] = $Users;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function getAllUsersWithTypeParent(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
			'user_type' => 'required',
			'parent_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;

	    try{

	    	$Users = UserMaster::where(['user_type'=>$request->user_type,'parent_id'=>$request->parent_id]);
	    	$response['Data'] = $Users;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


}