<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\SalesFilter;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'cont_phone1', 'price', 'location_id', 'send', 'approved', 'source', 'delete_at'
    ];

    public function location()
    {
        return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function saleDopInformation()
    {
        return $this->hasOne('App\Models\SaleDopInformation', 'sale_id');
    }

    public function builderNoDelete(){
        return $this->with(
            'location.microdistrict',
            'location.district',
            'location.city.districtCountry.region',
            'location.metro',
            'user.userInformation',
            'saleDopInformation')
            ->where('delete_at', 0);
    }

    public function builderDelete(){
        return $this->with(
            'location.microdistrict',
            'location.district',
            'location.city.districtCountry.region',
            'location.metro',
            'user.userInformation',
            'saleDopInformation')
            ->where('delete_at', 1);
    }
    public function builder(){
        return $this->with(
            'location.microdistrict',
            'location.district',
            'location.city.districtCountry.region',
            'location.metro',
            'user.userInformation',
            'saleDopInformation');
    }

    public function getAllSale($users = null, $index=0, $request=null)
    {
        $builder = $this->builderNoDelete();

        if ($request){
            $builder = (new SalesFilter($builder, $request))
                ->apply();
        }
        if (!is_array($users) && $users) {
            $users = array($users);
        }
        if ($users){
            $builder->whereIn('user_id', $users);
        }
       // dd($builder->get());
        $builder->offset(config('settings.limit') * $index)
            ->limit(config('settings.limit'));
        return  $builder->get();
    }

    public function getOne($id)
    {
        return $this->builder()
            ->where('id', $id)
            ->get()
            ->first();
    }

    public function createSale($request)
    {
        if (empty($request->all())) {
            return array('error' => __('messages.no_data'));
        }
        dd($request);
        if ($sale = $this->create($request->except('_token'))) {
            if ($sale->saleDopInformation()->create($request->except('_token'))) {

                return ['status' => __('messages.record.add')];
            }
        }

        return ['error' => __('messages.error')];

    }

    public function updateSale($request, $sale)
    {
        if (empty($request->all())) {
            return array('error' => __('messages.no_data'));
        }

        return ['error' => __('messages.error')];

    }

    public function deleteSale($sale)
    {
        if ($sale->update([
            'delete_at' => 1
        ])
        ) {
            return ['status' => __('messages.record.delete')];
        } else {
            return ['error' => __('messages.error')];
        }


    }


}
