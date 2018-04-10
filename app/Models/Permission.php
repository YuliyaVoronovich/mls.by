<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
{
    return $this->belongsToMany('App\Models\Role', 'permission_role');
}

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_permissions')->withPivot('access');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Permissioncategory', 'id');
    }


    public function changePermissions($request, $role)
    {
        $data = $request->except('_token');
        $this->sync($data['permission'], $role);

        return ['status'=> __('messages.record.update')];

    }

    public function arrayPermissions($array)
    {
        foreach ($array as $item){
            $this->array_permissions = array_add($this->array_permissions, $item->id-2, $item->id);
        }
        return  $this->array_permissions;
    }

    //синхронизация прав
    public function sync($data, $role)
    {
        if (isset($data)) {
            $role->savePermissions($data);
        } else {
            $role->savePermissions([]);
        }
        return true;

    }

}
