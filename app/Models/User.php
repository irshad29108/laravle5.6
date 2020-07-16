<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'decrypted_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get User Relationship to UserMaster.
    */
    public function master() {
        return $this->hasOne('App\Models\UserMaster');
    }
    /**
     * Get User Relationship to Rule.
    */
    public function ruleSetting() {
      return $this->belongsTo('App\Models\UserRuleSetting');
    }
    /**
     * Get User Relationship to Sms.
    */
    public function smsSetting() {
      return $this->belongsTo('App\Models\UserSmsSetting');
    }
    /**
     * Get User Relationship to Map.
    */
    public function mapSetting() {
      return $this->belongsTo('App\Models\UserMapSetting');
    }
    /**
     * Get User Relationship to Created By User.
    */
    public function createdBy() {
      return $this->hasMany('App\Models\UserMaster', 'created_by', 'id');
    }
    /**
     * Get All Relationships as one instance.
    */
    public static function relations() {
        return static::with(['master', 'ruleSetting', 'smsSetting', 'mapSetting', 'createdBy.login']);
    }


    // By Irshad
    public function userMaster() {
        return $this->hasOne('App\Models\UserMaster');
    }

}
