<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceUserDocument extends Model
{
	use Notifiable, SoftDeletes; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
   // protected $table = 'object_masters';
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

}

