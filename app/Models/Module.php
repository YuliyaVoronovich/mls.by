<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Module extends Model
{
    protected $fillable = [
        'title'
    ];

    public $timestamps = false;

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'company_modules');
    }

    public function createModule($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return array('error' => __('messages.no_data'));
        }
        if ($this->create($request->all())) {
            return ['status' =>  __('messages.record.add')];
        }
        return ['error' =>  __('messages.error')];

    }

    public function updateModule($request, $module)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return array('error' => __('messages.no_data'));
        }
        if ($module->fill($data)->update()) {
            return ['status' =>  __('messages.record.update')];
        }
        return ['error' => __('messages.error')];

    }

    public function deleteModule($module)
    {
        //  dd($module->company());

        //удалить связи в таблице company_module
        //dd($module);
        $module->company()->wherePivot('module_id',$module->id)->detach();

        if ($module->delete()) {
            return ['status' => __('messages.record.delete')];
        } else {
            return ['error' => __('messages.error')];
        }

    }
}
