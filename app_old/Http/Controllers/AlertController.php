<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User, UserMaster, DeviceMaster, ObjectMaster, Role, AlertTypeMaster, Alert};
use Illuminate\Database\Eloquent\Collection;
use Session;

class AlertController extends Controller
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
	 * Display a listing of the resource alerts.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
        $objects = DeviceMaster::all();
        $alerts = Alert::with(['type', 'object', 'company', 'reseller', 'branch'])->paginate(25);
		return view('pages.alerts.view')->with([
            'alerts' => $alerts
		]);
	}

    
    /**
    *  Create alerts.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        $resellers = UserMaster::where('role_id', Role::RESELLER)->get();
        $companies = UserMaster::where('role_id', Role::COMPANY)->get();
        $branches = UserMaster::where('role_id', Role::BRANCH)->get();
        $alerts = AlertTypeMaster::all();
        $objects = ObjectMaster::all();
        // dd($resellers, $companies, $branches);
        return view('pages.alerts.add')->with([
            'resellers' => $resellers,
            'companies' => $companies,
            'branches' => $branches,
            'objects' => $objects,
            'alerts' => $alerts
            ]);
        }
        
        /**
        *  Save alerts.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
        public function store(Request $request) {
            $validatedData = $request->validate([
                'company_id' => 'required',
                'branch_id' => 'required',
                'object_id' => 'required',
                'alert_name' => 'required',
                'alert_type' => 'required',
            ]);

            $alert = new Alert;
            $alert->company_id = $request->company_id;
            $alert->branch_id = $request->branch_id;
            $alert->object_id = $request->object_id;
            $alert->alert_name = $request->alert_name;
            $alert->alert_type = $request->alert_type;
            
            $alert->power_message = $request->power_message;
            $alert->power_status = $request->power_status;
            $alertMethodPower = is_array($request->power_alert_method) ? implode(',', $request->power_alert_method) : '';
            if (is_array($request->power_alert_method) && count($request->power_alert_method) > 0) {
                $alert->power_alert_method = $alertMethodPower;
                $alert->power_email_addresses = $request->alert_ign_on_email;
                $alert->power_mobile_numbers = $request->alert_ign_on_mobile;
                $alert->power_notification_sound = $request->alert_ign_on_notification;
            }
            
            $alert->sos_message = $request->sos_message;
            $alertMethodSOS = is_array($request->sos_alert_method) ? implode(',', $request->sos_alert_method) : '';
            if (is_array($request->sos_alert_method) && count($request->sos_alert_method) > 0) {
                $alert->sos_alert_method = $alertMethodSOS;
                $alert->sos_email_addresses = $request->alert_ign_on_email;
                $alert->sos_mobile_numbers = $request->alert_ign_on_mobile;
                $alert->sos_notification_sound = $request->alert_ign_on_notification;
            }

            $alert->ign_message = $request->ign_message;
            $alertMethodIGN = is_array($request->ign_alert_method) ? implode(',', $request->ign_alert_method) : '';
            if (is_array($request->ign_alert_method) && count($request->ign_alert_method) > 0) {
                $alert->ign_alert_method = $alertMethodIGN;
                $alert->ign_email_addresses = $request->alert_ign_on_email;
                $alert->ign_mobile_numbers = $request->alert_ign_on_mobile;
                $alert->ign_notification_sound = $request->alert_ign_on_notification;
            }
            
            $alert->os_parameter = $request->os_parameter;
            $alert->os_duration = $request->os_duration;
            $alert->os_message = $request->os_message;
            $alertMethodIGN = is_array($request->os_alert_method) ? implode(',', $request->os_alert_method) : '';
            if (is_array($request->os_alert_method) && count($request->os_alert_method) > 0) {
                $alert->os_alert_method = $alertMethodIGN;
                $alert->os_email_addresses = $request->alert_ign_on_email;
                $alert->os_mobile_numbers = $request->alert_ign_on_mobile;
                $alert->os_notification_sound = $request->alert_ign_on_notification;
            }
            $alert->save();
            Session::flash('success', 'Alert - '.$alert->alert_name.' Created Successfully!');
            return redirect()->route('alerts.view');
        }


        public function delete(Request $request) {
            $alert = Alert::find($request->id);
            Session::flash('error', 'Alert - '.$alert->alert_name.' Removed Successfully!');
            $alert->delete();
            return back();
        }

        public function changeStatus(Request $request){
            $alert = Alert::where('id', $request->alert_id)->first();
            if ($alert->enabled == $request->status) {
                Session::flash('success', 'Alert Enabled Successfully!');
                $alert->enabled = true;
            } else {
                Session::flash('error', 'Alert Disabled Successfully!');
                $alert->enabled = false;
            }
            $alert->save();
            return response()->json('success');
        }
    }
    