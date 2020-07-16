<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class poi extends Model
{
    //
    use SoftDeletes; 
    protected $guarded = [];
   /* protected $table = 'pois';*/
    protected $dates =['deleted_at'];
}
