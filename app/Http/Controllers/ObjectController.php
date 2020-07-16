<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User, ObjectMaster, Country, DeviceMaster, UserMaster, TimezoneMaster, Role};
use Carbon\Carbon;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Validator;
use Session;
use Excel;

class ObjectController extends Controller
{
  /**
  * Create a new controller instance for request authorization.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request) {
    if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
      $where = [];
    } elseif(Auth::user()->master->type->id == Role::BRANCH) {
      $where = ['company_branch_id' => Auth::user()->id];
    } else {
      $where = ['company_id' => Auth::user()->master->id];
    }
    $objects = ObjectMaster::where($where)->with('device_master', 'timezone', 'company', 'reseller', 'branch')->paginate(25);
    // dd($objects->take(7));
    return view('pages.objects.view')->with('objects', $objects);
  }


/**
 * Assign Vehicles
 */
public function assign(Request $request) {
    if (Auth::user()->master->type->id == Role::SUPER_ADMIN) {
      $where = [];
    } elseif(Auth::user()->master->type->id == Role::BRANCH) {
      $where = ['company_branch_id' => Auth::user()->id];
    } else {
      $where = ['company_id' => Auth::user()->master->id];
    }
    $objects = ObjectMaster::where($where)->with('device_master', 'timezone', 'company', 'reseller', 'branch')->get();
    // dd($objects->take(7));
    return view('pages.objects.assign')->with('objects', $objects);
  }


/**
 * Assign Vehicles
 */
public function assignObjects(Request $request) {
    if ($request->vehicles == NULL) {
        return back();
    }
    $objects = ObjectMaster::whereIn('id', $request->vehicles)->with('device_master', 'timezone', 'company', 'reseller', 'branch')->get();

    if (Auth::user()->master->type->id == Role::BRANCH) {
        $resellers = collect();
        $companies = collect();
        $branches = UserMaster::branches(null, Auth::user()->id)->get();
    } else {
        $resellers = UserMaster::resellers()->get();
        $companies = UserMaster::companies()->get();
        $branches = UserMaster::branches()->get();
    }
    // dd($objects->take(7));
    return view('pages.objects.assign_user')->with([
        'objects' => $objects,
        'resellers' => $resellers,
        'companies' => $companies,
        'branches' => $branches,
        'assignVehicles' => $request->vehicles
    ]);
  }

/**
 * Assign Vehicles
 */
public function saveAssignableVehicle(Request $request) {
    if ($request->vehicles == NULL) {
        return back();
    }
    foreach ($request->vehicles as $vehicleID) {

        if ($request->reseller_id == 0) {
            $branch = UserMaster::find($request->company_branch_id);
            $company = UserMaster::find($branch->parent_id);
            $reseller = UserMaster::find($company->parent_id);
        }

        $object = ObjectMaster::find($vehicleID);
        $object->reseller_id = $request->reseller_id == 0 ? $reseller->id : $request->reseller_id;
        $object->company_id = $request->reseller_id == 0 ? $company->id :  $request->company_id;
        $object->company_branch_id  = $request->reseller_id == 0 ? $branch->id : $request->company_branch_id;
        $object->save();
    }
    Session::flash('success', '('.count($request->vehicles).') Vehicles Assigned Successfully!');
    return redirect()->route('objects.view');
  }


    /**
	 * Add objects.
	 */
    public function bulkUpload() {
      if (Auth::user()->master->type->id == Role::BRANCH) {
        $resellers = collect();
        $companies = collect();
        $branches = UserMaster::branches(null, Auth::user()->id)->get();
      } else {
        $resellers = UserMaster::resellers()->get();
        $companies = UserMaster::companies()->get();
        $branches = UserMaster::branches()->get();
      }
      $timezone = TimezoneMaster::all();
      $countries = Country::all();
      return view('pages.objects.bulk')->with([
        'resellers' => $resellers,
        'companies' => $companies,
        'branches' => $branches,
        'countries' => $countries,
        'timezone' => $timezone,
      ]);
    }


      /**
	 * Add objects.
	 */
  public function bulkUploadStore(Request $request) {
    $data = array();
    $return = array();
    $finalResponse = array();

    $data = Excel::toArray(new ObjectController, $request->file('bulkFile'));
    foreach ($data as $key => $dataValues) {
        $keys= array();
        foreach ($dataValues[0] as $dataKeykeys => $dataKeyValue) {
            $keyWithHyphen = str_replace(' ', '', $dataKeyValue);
            $keys[] = str_replace('&', '', str_replace('(', '', str_replace(')', '', str_replace('/', '', str_replace('.', '', str_replace(' ', '', strtolower(str_replace('-', '', str_replace("*", "", $dataKeyValue)))))))));
        }
        for ($i=0; $i < count($data[0]); $i++) {
            $return[] = array_combine($keys, $dataValues[$i]);
        }
        $finalResponse[] = $return;
    }
    $insertableData = $finalResponse[0];
    // dd($insertableData, $request);

    $counter = 0;
    foreach ($insertableData as $key => $value) {
      $value = (object) $value;
      if ($counter != 0 && $value->devicename != "") {
        $device = new DeviceMaster;
        $object = new ObjectMaster;
        $device->name = $value->devicename;
        $device->sim_number = $value->msidnsimnumber1;
        $device->imei = $value->imeinumber;
        $device->mobile_number = 0;
        $device->registration_number = NULL;
        $device->save();

        $object->device_id = $device->id;
        $object->reseller_id = UserMaster::find($request->company)->parent_id;
        $object->company_id = $request->company;
        $object->company_branch_id = UserMaster::branches($request->company)->first()->id;
        // $object->state = $value->state;
        $object->device_timezone = $request->timezone;
        $object->name = $value->devicename;
        $object->plate_number = $value->vehiclenumber;
        $object->object_type = $value->vehiclemodel;
        $object->manufacture_date = date('Y-m-d H:i:s');
        $object->purchase_date = date('Y-m-d H:i:s');
        $object->installation_date = date('Y-m-d H:i:s');
        $object->save();
      }
      $counter++;
    }
    Session::flash('success', '('.$counter.') Vehicles Added Successfully!');
    return redirect()->route('objects.view');
  }

  /**
	 * Add objects.
	 */
	public function create() {
    if (Auth::user()->master->type->id == Role::BRANCH) {
      $resellers = collect();
      $companies = collect();
      $branches = UserMaster::branches(null, Auth::user()->id)->get();
    } else {
      $resellers = UserMaster::resellers()->get();
      $companies = UserMaster::companies()->get();
      $branches = UserMaster::branches()->get();
    }
	$deviceMaster = DeviceMaster::all();
    $timezone = TimezoneMaster::all();
    return view('pages.objects.add')->with([
			'resellers' => $resellers,
			'companies' => $companies,
			'branches' => $branches,
			'devices' => $deviceMaster,
			'timezone' => $timezone,
		]);
	}

  public function store(Request $request) {

    // Creating Object
    $rules =  [
      'reseller_id' => 'integer',
      'company_id' => 'integer',
      'company_branch_id' => 'required|integer',
      'object_name' => 'required|string|max:255',
    ];
    $messages = [
      'required' => 'Please fill :attribute field. This is required to create this vehicle.'
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      // dd($request);
      return back()->withErrors($validator)->withInput();
    }
    $device = new DeviceMaster;
    $device->name = $request->object_name;
    $device->mobile_number = 0;
    $device->sim_number = $request->sim_number;
    $device->imei = $request->imei_number;
    $device->registration_number = $request->registration_number;
    // $device->serial_number = $request->imei_number;
    $device->status = 1;
    $device->created_by = Auth::user()->id;
    $device->updated_by = Auth::user()->id;
    $device->save();
    if ($request->reseller_id == 0) {
      $branch = UserMaster::find($request->company_branch_id);
      $company = UserMaster::find($branch->parent_id);
      $reseller = UserMaster::find($company->parent_id);
    }

    $object = new ObjectMaster;
    $object->reseller_id = $request->reseller_id == 0 ? $reseller->id : $request->reseller_id;
    $object->company_id = $request->reseller_id == 0 ? $company->id :  $request->company_id;
    $object->company_branch_id  = $request->reseller_id == 0 ? $branch->id : $request->company_branch_id;
    $object->name   = $request->object_name;
    // $object->device_id    = $request->registration_number;
    $object->device_id    = $device->id;
    // $object->imei   = $request->imei_number;
    // $object->server
    // $object->sim_number     = $request->sim_number;
    $object->device_timezone    = $request->device_timezone ;
    $object->plate_number   = $request->plate_number;
    $object->object_type    = $request->object_type;
    $object->manufacture_date   =   Carbon::parse($request->manufacture_date)->format('Y-m-d');
    $object->purchase_date  = Carbon::parse($request->purchase_date)->format('Y-m-d');
    $object->installation_date  = Carbon::parse($request->installation_date)->format('Y-m-d');
    $object->odometer   = $request->odometer;
    $object->save();
    Session::flash('success', 'Vehicle - '. $device->imei .' Added Successfully!');
    return redirect()->route('objects.view');
  }

  public function edit($id) {
    $object = ObjectMaster::where('id', $id)->first()->load('device_master', 'timezone', 'company', 'reseller', 'branch');
    if (Auth::user()->master->type->id == Role::BRANCH) {
      $resellers = collect();
      $companies = collect();
      $branches = UserMaster::branches(null, Auth::user()->id)->get();
    } else {
      $resellers = UserMaster::resellers()->get();
      $companies = UserMaster::companies()->get();
      $branches = UserMaster::branches()->get();
    }
		$deviceMaster = DeviceMaster::all();
    $timezone = TimezoneMaster::all();
    return view('pages.objects.edit')->with([
      'data' => $object,
        'resellers' => $resellers,
        'companies' => $companies,
        'branches' => $branches,
        'devices' => $deviceMaster,
      'timezone' => $timezone,
      'id' => $id
      ]);
  }


  public function update(Request $request) {
    // Creating Object
    $rules =  [
      'reseller_id' => 'integer',
      'company_id' => 'integer',
      'company_branch_id' => 'required|integer',
      'object_name' => 'required|string|max:255',
    ];
    $messages = [
      'required' => 'Please fill :attribute field. This is required to create this vehicle.'
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }
    // dd($request);
    $object = ObjectMaster::find($request->id)->first()->load('device_master');
    $object->reseller_id = $request->reseller_id == 0 ? $reseller->id : $request->reseller_id;
    $object->company_id = $request->reseller_id == 0 ? $company->id :  $request->company_id;
    $object->company_branch_id  = $request->reseller_id == 0 ? $branch->id : $request->company_branch_id;
    $object->name   = $request->object_name;
    // $object->device_id    = $request->registration_number;
    $object->device_id    = $object->device_master->id;
    $object->device_timezone    = $request->device_timezone ;
    $object->plate_number   = $request->plate_number;
    $object->object_type    = $request->object_type;
    $object->manufacture_date   =   Carbon::parse($request->manufacture_date)->format('Y-m-d');
    $object->purchase_date  = Carbon::parse($request->purchase_date)->format('Y-m-d');
    $object->installation_date  = Carbon::parse($request->installation_date)->format('Y-m-d');
    $object->odometer   = $request->odometer;
    $object->save();

    $device = $object->device_master;
    $device->name = $request->object_name;
    $device->mobile_number = 0;
    $device->sim_number = $request->sim_number;
    $device->imei = $request->imei_number;
    $device->registration_number = $request->registration_number;
    // $device->serial_number = $request->imei_number;
    $device->status = 1;
    $device->created_by = Auth::user()->id;
    $device->updated_by = Auth::user()->id;
    $device->save();
    if ($request->reseller_id == 0) {
      $branch = UserMaster::find($request->company_branch_id);
      $company = UserMaster::find($branch->parent_id);
      $reseller = UserMaster::find($company->parent_id);
    }
    Session::flash('success', 'Vehicle - '. $device->imei .' Updated Successfully!');
    return redirect()->route('objects.view');
  }
}
