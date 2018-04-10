<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoRegion extends Model
{
    public function districtCountries()
    {
        return $this->hasMany('App\Models\GeoDistrictCountry','id');
    }
}
