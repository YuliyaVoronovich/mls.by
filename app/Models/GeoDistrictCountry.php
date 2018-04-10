<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoDistrictCountry extends Model
{
    public function region()
    {
        return $this->belongsTo('App\Models\GeoRegion','region_id');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\GeoCities','id');
    }
}
