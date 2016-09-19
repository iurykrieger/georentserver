<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idLocation";

    protected $table = 'location';

    protected $fillable = ['latitude','longitude','idCity'];

    public $timestamps = false;
}