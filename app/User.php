<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Auth;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $hidden = ['profileImage','remember_token','created_at','updated_at','password','idPreference','idCity','idLocation'];
    
    protected $primaryKey = "idUser";

    protected $table = 'user';

    protected $fillable = ['idLocation','idPreference','idCity','name','birthDate','email','phone','password','credits','type','distance','profileImage','remember_token','api_token'];

    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City','idCity');
    } 

    public function preference()
    {
        return $this->belongsTo('App\Preference','idPreference');
    } 

    public function matches()
    {
        return $this->hasManyThrough('App\Match','App\user',
                                     'idUser','idUser', 'idUser');
    } 

    public function userImages()
    {
        return $this->hasManyThrough('App\userImage','App\user',
                                     'idUser','idUser', 'idUser');
    } 

    public function residence()
    {
        return $this->hasManyThrough('App\Residence','App\user',
                                     'idUser','idUser', 'idUser');
    } 

    public function location()
    {
        return $this->belongsTo('App\Location','idLocation');
    } 

    public function profileImageUser(){
        return $this->hasOne('App\userImage', 'idUserImage','profileImage');
    }

}
