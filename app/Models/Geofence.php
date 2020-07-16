<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Geofence extends Model
{
    //
    use SoftDeletes; 
    protected $guarded = [];
    protected $dates =['deleted_at'];
}
