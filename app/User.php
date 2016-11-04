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

    //varios para 1 no inverso =D
    public function userImages()
    {
        return $this->hasManyThrough('App\userImage','App\user',
                                     'idUser','idUser', 'idUser');
    } 

}
