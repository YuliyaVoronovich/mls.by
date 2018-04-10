<?php
/**
 * Created by PhpStorm.
 * User: Юлия
 * Date: 29.03.2018
 * Time: 17:04
 */

namespace App\Filters;


class SalesFilter extends QueryFilter
{
    public function price($value)
    {
        if (!$value) return;
        return $this->builder->where('price',$value);
    }

/*    public function delete_at($value)
    {
        // if (!$value) return;
        return $this->builder->where('delete_at',$value);
    }*/

}