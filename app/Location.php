<?php

namespace App;

use App\City;
use Illuminate\Database\Eloquent\Model;

class Location extends Model 
{
    protected $hidden = ['idCity','remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idLocation";

    protected $table = 'location';

    protected $fillable = ['idCity','latitude','longitude'];

    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo('App\City','idCity');
    }  
}