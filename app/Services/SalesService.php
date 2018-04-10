<?php

namespace App\Services;

use App\Models\GeoCity;
use App\Models\GeoMetro;
use App\Models\GeoRegion;
use App\Models\Label;

class SalesService
{
    protected $region;
    protected $metro;
    protected $label;
    protected $city;

    public function __construct(GeoMetro $metro, GeoRegion $region, GeoCity $city, Label $label)
    {
        $this->region = $region;
        $this->city = $city;
        $this->metro = $metro;
        $this->label = $label;
    }

    public function regionsToArray()
    {
        $regions = $this->region->get();

        $regions_array = $regions->reduce(function ($regions_array, $region) {//функция которая будет выполнена для каждого элемента
            $regions_array[$region->id] = $region->title;
            return $regions_array;
        }, ['0' => '']);

        return $regions_array;
    }

    public function metroToArray()
    {
        $metro = $this->metro->get();

        $metro_array = $metro->reduce(function ($metro_array, $metro) {//функция которая будет выполнена для каждого элемента
            $metro_array[$metro->id] = $metro->title;
            return $metro_array;
        }, ['0' => '']);

        return $metro_array;
    }

    public function labelsToArray($category)
    {
        $labels = $this->label->where('category', $category)->get();

        $labels_array = $labels->reduce(function ($labels_array, $labels) {//функция которая будет выполнена для каждого элемента
            $labels_array[$labels->id] = $labels->title;
            return $labels_array;
        }, ['0' => '']);

        return $labels_array;
    }

    public function createSale($request)
    {
        if ($this->city->getIdCityOnTitle($request->city)) {
            $request->merge($data['city'] = $this->city->getIdCityOnTitle($request->city)->id);
        }

        dd($request);
        return $request;

    }


}