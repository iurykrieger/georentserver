<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idUserImage";

    protected $table = 'userImage';

    protected $fillable = ['idUser','path','resource','order'];

    public $timestamps = false;
}
