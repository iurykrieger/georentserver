<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $hidden = ['remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idPreference";

    protected $table = 'preference';

    protected $fillable = ['sponsor','room','bathroom','vacancy','laundry','income','condominuim','child','stay','pet'];

    public $timestamps = false;
}
