<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at','password','idPreference','idCity'];
    
    protected $primaryKey = "idUser";

    protected $table = 'user';

    protected $fillable = ['name','birthDate','email','phone','password','credits','type','distance'];

    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City','idCity');
    } 

    public function preference()
    {
        return $this->belongsTo('App\Preference','idPreference');
    } 

}
