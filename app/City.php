<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idCity";

    protected $table = 'city';

    protected $fillable = ['name','uf'];

    public $timestamps = false;
}