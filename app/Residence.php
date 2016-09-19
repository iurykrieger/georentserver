<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idResidence";

    protected $table = 'residence';

    protected $fillable = ['idLocation','idUser','idPreference','title','description','address','observation','price'];

    public $timestamps = false;
}
