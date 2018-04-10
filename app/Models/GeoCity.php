<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoCity extends Model
{
    public function districtCountry()
    {
        return $this->belongsTo('App\Models\GeoDistrictCountry', 'district_id');
    }

    public function districts()
    {
        return $this->hasMany('App\Models\GeoDistrict', 'id');
    }
    public function streets()
    {
        return $this->hasMany('App\Models\GeoStreet','id');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\Location', 'id');
    }

    public function getIdCityOnTitle($value)
    {
        if ($this->where('title','Пень')->get()->first()){
            return $this->where('title','Пень')->get()->first();
        } else {
            //добавить город
        }

    }
}
