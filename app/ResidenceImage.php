<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidenceImage extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idResidenceImage";

    protected $table = 'residenceImage';

    protected $fillable = ['idResidence','path','resource','order'];

    public $timestamps = false;
}
