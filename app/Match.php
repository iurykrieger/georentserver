<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $hidden = ['idResidence','idUser','remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idMatch";

    protected $table = 'match';

    protected $fillable = ['like','dateTime','diamond'];

    public $timestamps = false;

    public function residence()
    {
        return $this->belongsTo('App\Residence','idResidence');
    } 

    public function user()
    {
        return $this->belongsTo('App\User','idUser');
    } 
}
