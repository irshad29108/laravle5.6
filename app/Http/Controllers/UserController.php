<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, TimezoneMaster, UserMaster, MapMaster, UserMapSetting, UserRuleSetting, UserSetting, Country, State, City, BranchMaster, ObjectMaster, Role, AlertTypeMaster, DeviceData};
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

class UserController extends Controller
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
    
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index($type, $user_id = null)
    {
        $countries = Country::with('cities')->get();
		$pageName = Role::find($type)->name;
        $authUserRole = Auth::user()->master->role_id;
        $parent = collect();
		if ($user_id == "") {
            if($authUserRole == 1){
                if ($type == 2) {
                    $parent->put('admin', Auth::user());
                } elseif($type == 3) {
                    $parent->put('super_admin', Auth::user());
                    $parent->put('admin', User::with('master')->get()->map(function($q1) {
                        if (isset($q1->master->role_id) && $q1->master->role_id == Role::ADMIN) {
                            return $q1;
                        }
                    })->reject(function($q2) {
                        if ($q2 == null) {
                            return empty($q2);
                        }
                    }));
                    // dd($parent);
                } elseif($type == 4) {
					$parent->put('admin', Auth::user());
					$parent->put('reseller', User::with('master')->get()->map(function($q1) {
						if (isset($q1->master->role_id) && $q1->master->role_id == Role::RESELLER) {
                            return $q1;
                        }
                    })->reject(function($q2) {
                        if ($q2 == null) {
                            return empty($q2);
                        }
                    }));
                }
            } else {
				
                if ($type == ($authUserRole + 1)) {
                    $parent->put('admin', Auth::user());
                } elseif($type == ($authUserRole + 2)) {
                    $parent->put('admin', Auth::user());
                    $parent->put('reseller', User::with('master')->whereHas('master', function($query){
                        $query->where('parent_id', Auth::user()->id);
                    })->get());
                }
            }
        } else {
            $parent->put('admin', User::find($user_id));
        }
        // dd($parent);
        return view('pages.users.add')->with([
            'timezones' => TimezoneMaster::all(),
            'role_id' => $type,
            'page_name' => $pageName,
            'countries' => $countries,
            'authenticatedUser' => Auth::user()->id,
            'parent' => $parent
        ]);
    }
            
    /**
    * Get States
    *
    * @return \Illuminate\Http\Response
    */

    public function getStates(Request $request) {
    $states = '';
    if ($request->country_id != "") {
    $states = State::getAll($request->country_id);
    }
    return response()->json($states->values());
    }

    /**
    * Get Cities
    *
    * @return \Illuminate\Http\Response
    */

    public function getCities(Request $request) {
    $cities = '';
    if ($request->state_id != "") {
    $stateName = City::find($request->state_id);
    $cities = City::where('district', $stateName->district)->get();
    }
    return response()->json($cities->values());
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function addMaps(Request $request)
    {
    $data = $request->data;
    $data['count'] = UserMapSetting::where('user_id', $request->id)->count();
    for($i = 0; $i < count($request->data['maps']); $i++) {
    $mapmaster = new UserMapSetting;
    $mapmaster->user_id = $request->id;
    $mapmaster->map_id = $request->data['maps'][$i];
    $mapmaster->key = $request->data['map_keys'][$i];
    $mapmaster->map_project_id = $request->data['map_project_ids'][$i];
    $mapmaster->address_map_provider = $request->data['map_address_from_map_providers'][$i];
    $mapmaster->speed_limit_api = $request->data['map_speed_limit_apis'][$i];
    $mapmaster->default = $request->data['map_defaults'][$i];
    $mapmaster->save();
    }
    unset($data['maps']);
    foreach ($request->data['maps'] as $item) {
    $data['maps'][] = MapMaster::find($item)->type;
    }
    Session::flash('success', count($request->data['maps']) . ' Map(s) saved successfully!');
    return response()->json(['status' => '1', 'data' => $data,'message' => 'Maps saved successfully!'], 200);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function createUserRule(Request $request)
    {
    $rules =  [
    'rule_name' => 'required|string',
    'valid_from' => 'required',
    ];
    $messages = [
    'required' => ':attribute is required.'
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
    return back()->withErrors($validator)->withInput();
    }
    $userRule = new UserRuleSetting;
    $userRule->user_id = $request->user_id;
    $userRule->rule_name = $request->rule_name;
    $userRule->description = $request->description;
    $userRule->valid_from =  Carbon::parse($request->valid_from)->format('Y-m-d');
    $userRule->device_accuracy_tolerance = $request->device_accuracy_tolerance;
    $userRule->device_distance_variation_sign = $request->device_dictance_variation_sign;
    $userRule->device_distance_variation = $request->device_dictance_variation;
    $userRule->poi_tolerance = $request->poi_tolerance;
    $userRule->speed_tolerance = $request->speed_tolerance;
    $userRule->inactive_time = $request->inactive_time;
    $userRule->stoppage_time = $request->stoppage_time;
    $userRule->idle_time = $request->idle_time;
    $userRule->show_cluster = $request->show_cluster;
    $userRule->startup_screen = $request->startup_screen;
    $userRule->save();

    Session::flash('message', 'User Saved Successfully!');
    Session::flash('alert-class', 'alert-success');
    Session::flash('success', $request->rule_name . ' saved successfully!');
    return back();
    }



    /**
    * USERS SETTINGS
    * Show the application Admin Profile Page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function user($type) {
    // dd(Auth::user()->master->role_id);
    $timezones = TimezoneMaster::all();
    if (Auth::user()->master->role_id == 1):
    $userMaster = UserMaster::where(['role_id' => $type])->with(['cityMaster', 'parent'])->get();
    else:
    $userMasters = UserMaster::where(['role_id' => $type])->with(['cityMaster', 'parent' => function ($query) {
        $query->where('id', Auth::user()->id);
    }])->get();

    $userMaster = collect();
    foreach ($userMasters as $value) {
        if ($value->parent != null) {
            $userMaster->push($value);
        }
    }
    endif;
    $pageName = Role::find($type)->name;
    // dd($userMaster);
    return view('pages.users.view')->with([
    'timezones' => $timezones,
    'userMaster' => $userMaster,
    'page_name' => $pageName,
    'userType' => $type,
    ]);
    }

    /**
    * Display a listing of the resource.
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function userSettings($userType, $id) {
    $user_id = decrypt($id);
    $user = UserMaster::find($user_id);
    $userRules = UserRuleSetting::where('user_id', $user_id)->get();
    $alertTypes = AlertTypeMaster::all();
    $maps = MapMaster::where('status', 1)->get();
    $userMaps = UserMapSetting::where('user_id', $user_id)->get();
    return view('pages.users.settings')->with([
        'user' => $user,
        'userRules' => $userRules,
        'alerttypes' => $alertTypes,
        'maps' => $maps,
        'userMaps' => $userMaps,
        ]);
    }

    /**
    * Display a listing of the resource.
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function addCompanyUser($userType, $id) {
        $company_id = decrypt($id);
        // dd($company_id);
        $branches = UserMaster::where(['parent_id' => $company_id, 'role_id' => Role::BRANCH])->get();
        $users = UserMaster::where(['parent_id' => $company_id, 'role_id' => Role::USER])->whereIn('parent_id', $branches->pluck('id'))->get();
        $company = UserMaster::find($company_id);
        $countries = Country::all();
        $states = City::all()->unique('district');
        $cities = City::all();
        $timezones = TimezoneMaster::all();
        // dd($users);
        return view('pages.company.add-user')->with([
            'branches' => $branches,
            'company' => $company,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'timezones' => $timezones,
            'users' => $users,
        ]);
    }
    
    /**
    * USERS SETTINGS ENDS
    */
    
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        // dd($request);
        $rules =  [
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'user_name' => 'required|email|unique:users,email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/'       // must contain at least one Digit letter
            ],
            'confirm_password' => 'required|same:password',
        ];
        $messages = [
            'required' => 'Please fill :attribute field. This is required.',
            'regex' => ':attribute field must have at least one capital letter, one lowercase letter and one digit.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // dd($validator);
            return back()->withErrors($validator)->withInput();
        }
        $login_credentials = new User;
        $login_credentials->name = $request->name;
        $login_credentials->email = $request->user_name;
        $login_credentials->password = Hash::make($request->password);
        $login_credentials->save();
        
        $user = new UserMaster;
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->password = $request->password;
        $user->contact_person = $request->contact_person;
        $user->mobile_number = $request->mobile_number;
        $user->contact_number = $request->telephone_number;
        $user->fax_number = substr($request->fax_number, 0, 6);
        $user->city = $request->city;
        $user->zipcode = $request->zip_code;
        $user->full_address = $request->full_address;
        $user->user_id = $login_credentials->id;
        $user->role_id = $request->role_id;
        $user->parent_id = $request->parent_id;
        $user->created_by = Auth::user()->id;
        if ($request->hasFile('profile_image')) :
            $image = $request->file('profile_image');
            // dd($image->getClientOriginalExtension());
            $imageName = time() . '-' . $request->name. '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/company/profile/'), $imageName);
            $user->Photo = encrypt('uploads/company/profile/' . $imageName);
        endif;
        $user->save();
        
        if ($request->role_id == 4) {
            // Branch
            $branch_login_credentials = new User;
            $branch_login_credentials->name = $request->branch_name;
            $branch_login_credentials->email = $request->branch_user_name;
            $branch_login_credentials->password = Hash::make($request->branch_password);
            $branch_login_credentials->save();
            // Branch Master
            $branch = new UserMaster;
            $branch->name = $request->branch_name;
            $branch->user_name = $request->branch_user_name;
            $branch->password = $request->branch_password;
            $branch->contact_person = $request->branch_contact_person;
            $branch->mobile_number = $request->branch_mobile_number;
            $branch->fax_number = substr($request->branch_fax_number, 0, 6);
            $branch->city = $request->branch_city;
            $branch->zipcode = $request->branch_zip_code;
            $branch->full_address = $request->branch_full_address;
            $branch->role_id = Role::BRANCH;
            $branch->parent_id = $user->id;
            $branch->user_id = $branch_login_credentials->id;
            $branch->created_by = Auth::user()->id;
            $branch->save();
        }
        
        $user_settings = new UserSetting;
        $user_settings->user_id = $login_credentials->id;
        $user_settings->timezone_id = $request->time_zone;
        $user_settings->date_formate = $request->date_format;
        $user_settings->time_formate = $request->time_format;
        $user_settings->status = isset($request->user_status) && $request->user_status == 1 ? 1 : 0;
        $user_settings->filter_option = isset($request->default_filter) && $request->default_filter == 'on' ? 1 : 0;
        $user_settings->live_tracking = isset($request->smooth_tracking) && $request->smooth_tracking == 'on' ? 1 : 0;
        $user_settings->country_border = isset($request->country_border) && $request->country_border == 'on' ? 1 : 0;
        $user_settings->dispute_region = $request->disputed_region;
        $user_settings->immobilization = $request->immobilization;
        $user_settings->web_access = $request->web_access;
        $user_settings->mobile_access = $request->mobile_access;
        $user_settings->save();
        
        Session::flash('success', $request->name . ' saved successfully!');
        return back();
        
    }
    
    public function saveBranch(Request $request) {
        // dd($request);
        $rules =  [
            'branch_name' => 'required|string|max:255',
            'branch_email' => 'required|email|unique:users,email|unique:users,email',
            'branch_password' => [
                'required',
                'min:6',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/'       // must contain at least one Digit letter
            ],
            'branch_confirm_password' => 'required|same:branch_password',
        ];
        $messages = [
            'required' => 'Please fill :attribute field. This is required.',
            'regex' => ':attribute field must have at least one capital letter, one lowercase letter and one digit.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // dd($validator);
            return back()->withErrors($validator)->withInput();
        }
        // dd($request);
        // Branch
        $branch_login_credentials = new User;
        $branch_login_credentials->name = $request->branch_name;
        $branch_login_credentials->email = $request->branch_email;
        $branch_login_credentials->password = Hash::make($request->branch_password);
        $branch_login_credentials->save();
        // Branch Master
        $branch = new UserMaster;
        $branch->name = $request->branch_name;
        $branch->user_name = $request->branch_email;
        $branch->password = $request->branch_password;
        $branch->contact_person = $request->branch_contact_person;
        $branch->mobile_number = $request->branch_mobile_number;
        $branch->fax_number = substr($request->branch_fax_number, 0, 6);
        $branch->city = $request->branch_city;
        $branch->zipcode = $request->branch_zip_code;
        $branch->full_address = $request->branch_full_address;
        $branch->role_id = Role::BRANCH;
        $branch->parent_id = $request->parent_id;
        $branch->user_id = $branch_login_credentials->id;
        $branch->created_by = Auth::user()->id;
        $branch->save();
        Session::flash('success', $request->branch_name . ' saved successfully!');
        return redirect()->back();
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
                