<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    protected $fillable = [
        'company_id', 'id_domovita', 'login_onliner', 'pass_onliner', 'login_realt', 'pass_realt'
    ];
    public $timestamps = false;

    /*protected $guarded = [''];*/

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
