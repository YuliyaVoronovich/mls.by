<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
    public function permissions()
    {
        return $this->hasMany('App\Models\Permission', 'category_id');
    }
}
