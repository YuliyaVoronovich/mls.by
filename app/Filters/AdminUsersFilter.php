<?php
/**
 * Created by PhpStorm.
 * User: Юлия
 * Date: 20.03.2018
 * Time: 13:34
 */

namespace App\Filters;


class AdminUsersFilter extends QueryFilter
{
    public function company($value)
    {
        if (!$value) return;
        return $this->builder->where('company_id',$value);
    }

    public function phone($value)
    {
        if (is_null($value)) return;
        return $this->builder->whereHas('userInformation', function ($query) use ($value) {
            $query->where('phone1','like',"%$value%");
        });
    }
    public function delete_user($value)
    {
       // if (!$value) return;
        return $this->builder->where('delete_user',$value);
    }

}