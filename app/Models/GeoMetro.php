<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoMetro extends Model
{
    public function locations()
    {
        return $this->hasMany('App\Models\Location','id');
    }
}
