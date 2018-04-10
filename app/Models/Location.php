<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    public function city()
    {
        return $this->belongsTo('App\Models\GeoCity','city_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\GeoDistrict','district_id');
    }

    public function microdistrict()
    {
        return $this->belongsTo('App\Models\GeoMicrodistrict','microdisctrict_id');
    }

    public function metro()
    {
        return $this->belongsTo('App\Models\GeoMetro','metro_id');
    }

    public function street()
    {
        return $this->belongsTo('App\Models\GeoStreet','street_id');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale','id');
    }

}
