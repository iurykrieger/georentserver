<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $hidden = ['idUser','remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idUserImage";

    protected $table = 'userImage';

    protected $fillable = ['path','resource','order'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User','idUser');
    } 
}
