<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoDistrict extends Model
{
    public function city()
    {
        return $this->belongsTo('App\Models\GeoCity','city_id');
    }
    public function locations()
    {
        return $this->hasMany('App\Models\GeoLocation','id');
    }

    public function microdistricts()
    {
        return $this->hasMany('App\Models\GeoMicrodistrict','id');
    }
}
