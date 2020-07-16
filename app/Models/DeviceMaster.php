<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DeviceMaster extends Model
{
    //
    protected $guarded = [];
    protected $table = 'device_masters';
    /**
     * UserMaster Relationship with UserType.
    */
    public function locations() {
        return $this->hasMany('App\Models\DeviceData', 'IMEI', 'imei');
    }
    
    /**
     * UserMaster Relationship with Object.
    */
    public function object() {
        return $this->hasOne('App\Models\ObjectMaster', 'device_id');
    }
}
