<?php
/**
 * Created by PhpStorm.
 * User: Юлия
 * Date: 29.03.2018
 * Time: 16:24
 */

namespace App\Services;


use App\Models\Label;

class LabelsService
{
    protected $label;

    public function __construct(Label $label)
    {
        $this->label = $label;
    }

    public function labelsToArray()
    {
        $labels = $this->label->get();

        $labels_array = array();
        for ($i = 0; $i < count($labels); $i++) {
            $labels_array[$labels[$i]->id]=$labels[$i]->title;
        }

        return $labels_array;

    }

}