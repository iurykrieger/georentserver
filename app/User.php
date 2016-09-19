<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at','password'];
    
    protected $primaryKey = "idUser";

    protected $table = 'user';

    protected $fillable = ['name','birthDate','email','phone','password','credits','type','distance','idPreference','idCity'];

    public $timestamps = false;
}
