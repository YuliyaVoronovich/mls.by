<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDopInformation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'phone', 'internet'
    ];

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale', 'id');
    }
}
