<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    City, 
    State, 
    Country, 
    UserMaster, 
    User,
    Role,
    UserRuleSetting,
    UserSetting,
    AlertTypeMaster,
    MapMaster,
    UserMapSetting,
    TimezoneMaster
};
use Auth;
use Session;
use Hash;
use Illuminate\Support\Facades\Validator;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::with('cities')->get();
        return view('pages.account.view')->with([
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccountDetails(Request $request, $master_id) {
        $rules =  [
            'user_name' => 'required|email',
            'contact_person' => 'required',
            'mobile_number' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'full_address' => 'required'
        ];
        $messages = [
            'required' => ':attribute is required to update your details.',
            'email' => ':attribute needs to be a valid email, So we can use this for email communication.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $master = UserMaster::find($master_id);
        // dd($master);
        $master->name = $request->name;
        $master->user_name = $request->user_name;
        $master->contact_person = $request->contact_person;
        $master->mobile_number = $request->mobile_number;
        $master->fax_number = $request->fax_number;
        $master->city = $request->city;
        $master->zipcode = $request->zip_code;
        $master->full_address = $request->full_address;
        if ($request->hasFile('profile_image')) :
            $image = $request->file('profile_image');
            // dd($image->getClientOriginalExtension());
            $imageName = time() . '-' . $request->name. '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/company/profile/'), $imageName);
            $master->photo = encrypt('uploads/company/profile/' . $imageName);
        endif;
        $master->save();

        $user = User::find($master->user_id);
        $user->email = $request->user_name;
        $user->name = $request->name;
        $user->save();


        Session::flash('success', 'Your details updated successfully!');
        $countries = Country::with('cities')->get();
        return redirect()->route('account.edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('pages.account.change-password');
    }

    
    
    /**
     * Update the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $master_id){
        $rules =  [
            'old_password' => 'required|exists:user_masters,password',
            'password' => 'required|confirmed',
        ];
        $messages = [
            'required' => ':attribute is required to update your details.',
            'confirmed' => 'New password did not match with confirm new password.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            // dd($validator->errors()->first());
            return back()->withErrors($validator)->withInput();
        }
        if($request->password != $request->old_password) {
            $master = UserMaster::find($master_id);
            $master->password = $request->password;
            $master->save();
            $user = User::find($master->user_id);
            $user->password = Hash::make($request->password);
            $user->save();
            Session::flash('success', 'Your password updated successfully!');
        } else {
            Session::flash('error', 'Old and New password should not be same!');
        }
        return back();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $user_id = Auth::user()->id;
        $user = UserMaster::find($user_id);
		$userRules = UserRuleSetting::where('user_id', $user_id)->get();
		$alertTypes = AlertTypeMaster::all();
		$maps = MapMaster::where('status', 1)->get();
        $userMaps = UserMapSetting::where('user_id', $user_id)->get();
        
        return view('pages.account.settings')->with([
			'userRules' => $userRules,
			'alerttypes' => $alertTypes,
			'maps' => $maps,
			'userMaps' => $userMaps,
		]);
    }

    /**
     * Update the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(Request $request, $master_id){
        $rules =  [
            'default_language' => 'required'
        ];
        $messages = [
            'required' => ':attribute is required to update your details.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $authUser = Auth::user()->master;
        
        // ********* USER SETTINGS ********* //
        $user = UserSetting::find($master_id);
        if ($user) {
            $user->timezone_id = $authUser->timezone != '' ? $authUser->timezone : 1;
            $user->date_formate = $authUser->date_formate;
            $user->time_formate = $authUser->time_formate;
            // $user->status = $authUser->timezone;
            // $user->store_action = $authUser->timezone;
            // $user->filter_option = $authUser->timezone;
            // $user->live_tracking = $authUser->timezone;
            // $user->country_border = $authUser->timezone;
            // $user->dispute_region = $authUser->timezone;
            $user->immobilization = $authUser->is_immobilization;
            $user->web_access = $authUser->is_web_access;
            $user->mobile_access = $authUser->is_mobile_access;
            $user->save();
        } else {
            $user = new UserSetting;
            $user->timezone_id = $authUser->timezone != '' ? $authUser->timezone : 1;
            $user->date_formate = $authUser->date_formate != "" ? $authUser->date_format : "DD-MM-YYYY";
            $user->time_formate = $authUser->time_formate != "" ? $authUser->time_formate : "24-Hours";
            // $user->status = $authUser->timezone;
            // $user->store_action = $authUser->timezone;
            // $user->filter_option = $authUser->timezone;
            // $user->live_tracking = $authUser->timezone;
            // $user->country_border = $authUser->timezone;
            // $user->dispute_region = $authUser->timezone;
            $user->immobilization = $authUser->is_immobilization;
            $user->web_access = $authUser->is_web_access;
            $user->mobile_access = $authUser->is_mobile_access;
            $user->save();
        }
        // ********* USER SETTINGS ENDS ********* //



        Session::flash('success', 'Your basic setup updated successfully!');
        return back();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function basicSetup()
    {
        $type = Auth::user()->master->type->id;
		$timezones = TimezoneMaster::all();
		if (Auth::user()->master->role_id == 1):
			$userMaster = UserMaster::where(['role_id' => $type])->with('parent')->get();
		else:
			$userMasters = UserMaster::where(['role_id' => $type])->with(['parent' => function ($query) {
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
        return view('pages.account.basic-setup')->with([
			'timezones' => $timezones,
			'userMaster' => $userMaster,
			'page_name' => $pageName,
			'userType' => $type,
		]);
    }


    public function updateBasicSetup(Request $request, $master_id) {
        $rules =  [
            'default_language' => 'required'
        ];
        $messages = [
            'required' => ':attribute is required to update your details.'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $authUser = Auth::user()->master;
        $user_settings = new UserSetting;
        $user_settings->user_id = Auth::user()->id;
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
        Session::flash('success', 'Your settings are updated successfully!');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emailSettings()
    {
        return view('pages.account.change-password');
    }

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
        //
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
