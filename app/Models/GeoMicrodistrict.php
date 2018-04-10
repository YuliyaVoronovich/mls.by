<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoMicrodistrict extends Model
{
    public function district()
    {
        return $this->belongsTo('App\Models\GeoDistrict','district_id');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\GeoLocation','id');
    }
}
