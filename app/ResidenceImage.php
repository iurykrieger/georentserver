<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResidenceImage extends Model
{
    protected $hidden = ['idResidence','remember_token','created_at','updated_at'];
    
    protected $primaryKey = "idResidenceImage";

    protected $table = 'residenceImage';

    protected $fillable = ['idResidence','path','resource','orderImage'];

    public $timestamps = false;

    public function residence()
    {
        return $this->belongsTo('App\Residence','idResidence');
    } 
}
