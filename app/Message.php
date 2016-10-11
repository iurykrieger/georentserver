<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $hidden = ['idFrom','idTo','remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idMessage";

    protected $table = 'message';

    protected $fillable = ['message','dateTime','resource','path'];

    public $timestamps = false;

    public function userFrom()
    {
        return $this->belongsTo('App\User','idFrom', 'idUser');
    } 

    public function userTo()
    {
        return $this->belongsTo('App\User','idTo','idUser');
    } 
}
