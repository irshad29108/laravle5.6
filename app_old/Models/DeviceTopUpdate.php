<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DeviceTopUpdate extends Model
{
   // use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   /* protected $fillable = [
        'user_name', 'email', 'password','provider','provider_id','avatar','first_name','middle_name','last_name','role_id','mobile_number','status'
    ];*/
    protected $guarded = [];
    protected $table = 'device_data_top_updates';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
