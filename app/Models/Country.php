<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    
    /**
    * State
    */
    public function states() {
        
    }

    
    /**
    * City
    */
    public function cities() {
        return $this->hasMany('App\Models\City', "country_code", "code");
    }
    
}
