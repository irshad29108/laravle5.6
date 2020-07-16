<?php
namespace App\Http\Controllers\API\Common;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\{UserType,Country,State,City,DeviceTopUpdate,HealthmonitoringTopUpdate};
use DB;
use Validator;
use Helper;

class MasterController extends Controller {


	 public function getUsersType(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$UserType = UserType::where('status',1)->get();
	    	$response['Data'] = $UserType;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	  public function getCountry(Request $request){

	 	$response['status'] = 100;
	 	$response['message'] = 'Error';
	    try{

	    	$UserType = Country::get();
	    	$response['Data'] = $UserType;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }

	 public function getState(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';


	 	$validator = Validator::make($request->all(),[
			'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;


	    try{

	    	$UserType = State::where('country_id',$request->country_id)->get();
	    	$response['Data'] = $UserType;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function getcity(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';


	 	$validator = Validator::make($request->all(),[
			'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
            $response['status'] = 0;
            $response['message'] = 'Error: Validation Failed!';
        }
        
        if (!$response['status'])
        return $response;


	    try{

	    	$UserType = City::where('state_id',$request->state_id)->get();
	    	$response['Data'] = $UserType;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	 public function getDeviceTopUpdateData(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
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

	    	$data = DeviceTopUpdate::where('imei',$request->imei)->get();
	    	$response['Data'] = $data;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }


	  public function getDevicehealthmonitoringTopUpdateData(Request $request){


	 	$response['status'] = 100;
	 	$response['message'] = 'Error';

	 	$validator = Validator::make($request->all(),[
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

	    	$data = HealthmonitoringTopUpdate::where('imei',$request->imei)->get();
	    	$response['Data'] = $data;
	    	$response['message'] = 'success';
		    $response['status'] = 200;
		    
		}catch(\Exception $e){
			$response['message'] = $e->getMessage();
		}

		return $response;

	 }

}

