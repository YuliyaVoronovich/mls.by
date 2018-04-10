<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoStreet extends Model
{
    public function locations()
    {
        return $this->hasMany('App\Models\Location','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\GeoCity', 'city_id');
    }
}
