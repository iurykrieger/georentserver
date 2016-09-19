<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idMatch";

    protected $table = 'match';

    protected $fillable = ['idResidence','idUser','like','dateTime','diamond'];

    public $timestamps = false;
}
