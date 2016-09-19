<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idMessage";

    protected $table = 'message';

    protected $fillable = ['from','to','message','dateTime','resource','path'];

    public $timestamps = false;
}
