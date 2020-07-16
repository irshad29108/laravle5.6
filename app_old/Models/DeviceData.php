<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{
    protected $table = 'device_data';


    public static function trips() {
        return static::all();
    }
}
