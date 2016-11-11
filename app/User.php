<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at','password','idPreference','idCity'];
    
    protected $primaryKey = "idUser";

    protected $table = 'user';

    protected $fillable = ['password','idPreference','idCity','name','birthDate','email','phone','password','credits','type','distance','profileImage'];

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

}
