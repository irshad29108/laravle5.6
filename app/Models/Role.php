<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Available User Roles IDs
    */
    
    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const RESELLER = 3;
    const COMPANY = 4;
    const BRANCH = 5;
    const USER = 6;

    /**
     * User Role Names
     */

    
    const ROLE_SUPER_ADMIN = 'superadmin';
    const ROLE_ADMIN = 'admin';
    const ROLE_RESELLER = 'reseller';
    const ROLE_COMPANY = 'company';
    const ROLE_BRANCH = 'branch';
    const ROLE_USER = 'user';
    
}
