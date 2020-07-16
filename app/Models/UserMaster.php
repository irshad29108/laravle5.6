<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use Auth;

class UserMaster extends Model
{
  // use HasApiTokens, Notifiable;
  
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  /* protected $fillable = [
    'user_name', 'email', 'password','provider','provider_id','avatar','first_name','middle_name','last_name','role_id','mobile_number','status'
  ];*/
  protected $guarded = [];

  const RESELLER_ROLE_ID = 3;
  const OTP_EXPIRED_TIME = 120; // 120 second 
  const OTP_LENGTH = 6; // 6 Charecter 

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $dates = ['deleted_at'];
    
    /**
     * UserMaster Relationship with UserType.
    */
    public function login() {
      return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * UserMaster Relationship with UserType.
    */
    public function type() {
      return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    /**
     * UserMaster Relationship with UserType.
    */
    public function parent() {
      return $this->hasOne('App\Models\User', 'id', 'parent_id');
    }

    /**
    * UserMaster Relationship with CITY.
    */
    public function cityMaster() {
      return $this->hasOne('App\Models\City', 'id', 'city');
    }


    /**
     * 
     * Get All Admin
     */

    public static function admins($parent = null) {
      $where = array('role_id' => Role::ADMIN, 'parent_id' => $parent);
      return static::where($where);
    }
    

    /**
     * 
     * Get All Resellers
     */

    public static function resellers($parent = null) {
      $where = $parent != null ? array('role_id' => Role::RESELLER, 'parent_id' => $parent) : array('role_id' => Role::RESELLER);
      return static::where($where);
    }

    /**
     * 
     * Get All Companies
     */

    public static function companies($parent = null) {
      $where = $parent != null ? array('role_id' => Role::COMPANY, 'parent_id' => $parent) : array('role_id' => Role::COMPANY);
      return static::where($where);
    }
    

    /**
     * 
     * Get All Branches
     */

    public static function branches($parent = null, $id = null) {
      $where = $parent != null ? array('role_id' => Role::BRANCH, 'parent_id' => $parent) : ($id != null ? array('role_id' => Role::BRANCH, 'id' => $id) : array('role_id' => Role::BRANCH));
      return static::where($where);
    }

    /**
     * 
     * Get All User Group
     */

    public static function usersGroup($parent = null) {
      $where = $parent != null ? array('role_id' => Role::USER_GROUP, 'parent_id' => $parent) : array('role_id' => Role::USER_GROUP);
      return static::where($where);
    }
    
    /**
     * 
     * Get All User
     */

    public static function users($parent = null) {
      $where = $parent != null ? array('role_id' => Role::USER, 'parent_id' => $parent) : array('role_id' => Role::USER);
      return static::where($where);
    }
     /**
     * 
     * Get All Childs
     */
    public static function childs($parent = null) {
      switch ($parent) {
        case Role::ADMIN:
          $reseller = static::where([['parent_id', $parent], ['role_id', Role::RESELLER]]);
          $companies = static::where('parent_id', 'IN', $parent->pluck('id'));
          dd($companies);
          break;
        
        case Role::RESELLER:
          # code...
          break;
        
        case Role::COMPANY:
          # code...
          break;
        
        case Role::USER:
          # code...
          break;
              
        default:
          # code...
          break;
      }
    }


  }
  