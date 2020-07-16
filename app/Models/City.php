<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'cities';

    
    /**
    * Country
    */
    public function countries() {
        return $this->hasOne('App\Models\Country', "code", "country_code");
    }
}
