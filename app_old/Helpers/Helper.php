<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\{OtpVerification,UserMaster};
use File;
use Storage;

class Helper {


	private static function generateNumericOTP($n,$type) { 
   
	    if($type == 'password'){
	    	$generator = "#ABCDEFGHIJKLMNOPQRSTUVWXYZ1357902468@";
	    }else{
	    	$generator = "1357902468";
	    }

	    $result = ""; 

	    for ($i = 1; $i <= $n; $i++) { 
	        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
	    } 
	    return $result; 
	} 

    public static function otpSend($mobile,$user_id,$otp_type='otp') {

     	try{

     		$response['message'] = 'error';
			$curl = curl_init();
			$from_id = "IACTRK";
			$to_number = $mobile;
			$otp = self::generateNumericOTP(UserMaster::OTP_LENGTH,$otp_type);
			$message= $otp;

			curl_setopt_array($curl, array(

				CURLOPT_URL => "http://pointsms.in/API/sms.php?from=".$from_id."&to=".$to_number."&msg=".$message."&username=genyventures&password=genyv9876&dnd_check=0&type=1",

		          CURLOPT_RETURNTRANSFER => true,
		          CURLOPT_ENCODING => "",
		          CURLOPT_TIMEOUT => 30000,
		          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		          CURLOPT_CUSTOMREQUEST => "POST",
		          CURLOPT_HTTPHEADER => array(
		              'Content-Type: application/json',
		          ),
	     	 ));

			$last_result = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if(!$err) {

				$otpObject = new OtpVerification;
		    	$otpObject->user_id = $user_id;
		    	$otpObject->mobile_number = $mobile;
		    	$otpObject->otp = $otp;
		    	$otpObject->type = '1'; //($otp_type=='password')?'password':'otp';

		    	if($otpObject->save()){
				 	$response['message'] = 'success';
				}
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

    }


     public static function checkDeviceInStock($imei) {

     	try{
     		$response['message'] = 'error';
			$curl = curl_init();

			curl_setopt_array($curl, array(

				CURLOPT_URL => "http://13.232.230.41/IAC-DEV/public/api/checkDeviceInMIS?imeino=".$imei,

		          CURLOPT_RETURNTRANSFER => true,
		          CURLOPT_ENCODING => "",
		          CURLOPT_TIMEOUT => 30000,
		          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		          CURLOPT_CUSTOMREQUEST => "GET",
		          CURLOPT_HTTPHEADER => array(
		              'Content-Type: application/json',
		          ),
	     	 ));

			$last_result = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if(!$err) {

				$response['message'] = 'success';
				$response['Data'] = json_decode($last_result,TRUE);
			}

		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

    }



    public static function uploadFiles($path,$base64_string){

    	if(!File::isDirectory($path)){
	        File::makeDirectory($path, 0777, true, true);
	    }

	    $img = "data:image/jpg;base64,".$base64_string;
	    $img = str_replace('data:image/jpg;base64,', '', $img);
	    $img = str_replace(' ', '+', $img);
	    $data = base64_decode($img);

	    $img_name = substr(md5(round(microtime(true)*1000)),-8).'.jpg';
	    $file = $path.$img_name;

	    $success = Storage::put($file, $data);

	    return $success ? $img_name : '';

	}


}