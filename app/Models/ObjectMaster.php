<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObjectMaster extends Model
{
	use Notifiable, SoftDeletes; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'object_masters';
    protected $dates = ['deleted_at'];
   /*
   	protected $hidden = [];
    protected $dateFormat = 'U';
    protected $casts = [
        'is_admin' => 'boolean',
    ];
    protected $casts = [
	    'created_at' => 'datetime:Y-m-d',
	];
    */
    public function device_master() {
        return $this->belongsTo('App\Models\DeviceMaster', 'device_id');
    }

    /**
     * Reseller
    */
    public function reseller() {
        return $this->belongsTo('App\Models\UserMaster', 'reseller_id');
    }

     /**
     * Company
    */
    public function company() {
        return $this->belongsTo('App\Models\UserMaster', 'company_id');
    }
    
    /**
    * Company
    */
    public function branch() {
        return $this->belongsTo('App\Models\UserMaster', 'company_branch_id');
    }

    /**
    * Timezone
    */
    public function timezone() {
        return $this->belongsTo('App\Models\TimezoneMaster', 'device_timezone');
    }
}

