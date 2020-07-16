<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    //
    use SoftDeletes; 
    protected $guarded = [];
    protected $table = 'alert_masters';
    protected $dates =['deleted_at'];

    public function type(){
        return $this->hasOne('App\Models\AlertTypeMaster', 'id', 'alert_type');
    }

    public function object()
    {
        return $this->belongsTo('App\Models\ObjectMaster');
    }

    public function reseller()
    {
        return $this->belongsTo('App\Models\UserMaster', 'reseller_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\UserMaster', 'company_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\UserMaster', 'branch_id');
    }
}
