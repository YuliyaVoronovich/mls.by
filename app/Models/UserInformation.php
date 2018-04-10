<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $fillable = [
        'user_id', 'name', 'surname', 'patronymic', 'phone1', 'phone2', 'passport', 'date_of_birth', 'photo'
    ];

    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
