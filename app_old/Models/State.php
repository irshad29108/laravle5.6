<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $table = 'cities';
    
    public static $states;
    /**
    * Country
    */
    public static function getAll($company_id = "") {
        if ($company_id == "") {
            return City::with('countries')->get()->unique('district');
        } else {
            return City::whereHas('countries', function($q) use ($company_id) {
                $q->where('id', $company_id);
            })->with('countries')->get()->unique('district');
        }
    }

    
    /**
    * City
    */
    public function city() {
        return $this->hasOne();
    }
}
