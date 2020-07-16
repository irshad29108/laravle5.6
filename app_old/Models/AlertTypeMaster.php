<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AlertTypeMaster extends Model
{
    //
    const POWER = 1;
    const SOS = 2;
    const IGNITION = 3;
    const OVERSPEED = 4;

    protected $guarded = [];
    protected $table = 'alert_type_masters';
}
