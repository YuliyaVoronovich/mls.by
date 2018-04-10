<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'title',
    ];

    public $timestamps = false;

    /*public function users()
    {
        return $this->belongsTo('App\User', 'role_id');
    }*/
    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }

    /*public function companies()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }*/

    public function hasPermission($name, $category, $require = FALSE)
    {

        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName, $category);
                if ($hasPermission && !$require) {
                    return TRUE;
                } else if (!$hasPermission && $require) {
                    return FALSE;
                }
            }
            return $require;
        } else {
            foreach ($this->permissions as $permission) {
                if ($permission->title == $name && $permission->category_id === $category) {
                    return TRUE;
                }

            }
        }

    }

    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            //синхронизация связанных моделей по связующей таблице
            $this->permissions()->sync($inputPermissions);
        } else {
            //для конкретной роли будут удалены все записи(отвязка связанных записей)
            // $this->permissions()->detach();
            $this->permissions()->sync([]);
        }

        return TRUE;
    }


}
