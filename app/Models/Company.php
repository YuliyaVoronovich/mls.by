<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;


class Company extends Model
{

    protected $fillable = [
        'title', 'name_organization', 'fio_director', 'phone_director', 'license', 'license_issued', 'license_from', 'license_to', 'prefix'
    ];

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module', 'company_modules');
    }

    public function companyInformation()
    {
        return $this->hasOne('App\Models\CompanyInformation', 'company_id');
    }

    /*public function roles()
    {
        return $this->hasMany('App\Role');
    }*/


    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_id');
    }


    public function saveModules($inputModules)
    {
        if (!empty($inputModules)) {
            //синхронизация связанных моделей по связующей таблице
            $this->modules()->sync($inputModules);
        } else {
            //для конкретной роли будут удалены все записи(отвязка связанных записей)
            $this->modules()->detach();
        }

        return TRUE;
    }

    public function hasModule($title, $require = FALSE)
    {
        if (is_array($title)) {
            foreach ($title as $moduleName) {

                $moduleName = $this->hasModule($moduleName);
                if ($moduleName && !$require) {
                    return TRUE;
                } else if (!$moduleName && $require) {
                    return FALSE;
                }
            }
            return $require;
        } else {
            foreach ($this->modules as $module) {
                if ($module->title == $title) {
                    return TRUE;
                }

            }
        }

    }

    public function getOneCompany($id)
    {
        return $this->with('modules', 'companyInformation')
            ->where('id', $id)
            ->get()
            ->first();
    }


    public function createCompany($request)
    {
        if (empty($request->all())) {
            return array('error' => __('messages.no_data'));
        }

        $per = new Permission();
        $permissions = $per->where('title', '<>', 'ACCESS_ADMIN')->get();

        $array_permissions = $per->arrayPermissions($permissions);

        //создание компании
        if ($company = $this->create($request->except('_token'))) {
            //добавление информации о компании
            if ($company->companyInformation()->create($request->except('_token'))) {

                //синхронизация модулей компании
                if (isset($request->module)) {
                    $company->saveModules($request->module);
                } else {
                    $company->saveModules([]);
                }
                //добавление сотрудника
                $data_user = $request->only('login', 'password');
                $data_user['password'] = Hash::make($request->password);
                $data_user['password_first'] = $request->password;//нужен или нет

                //добавить роль admin_company
                $role = new Role();

                $role = $role->create([
                    'title' => 'Админ компании ' . $company->title
                ]);
                $data_user['role_id'] = $role->id;

                //создание юзера
                $user = $company->users()->create($data_user)->userInformation()->create([
                    'name' => $request->name
                ]);
                 //добавление сотруднику в роли admin_company всех прав
                $per->sync($array_permissions, $role);

                return ['status' => __('messages.record.add')];
            }
        }
        return ['error' => __('messages.error')];
    }


    public function updateCompany($request, $company)
    {
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return array('error' => __('messages.no_data'));
        }
        if ($company->fill($data)->update()) {

            //синхронизация модулей компании
            if (isset($request->module)) {
                $company->saveModules($request->module);
            } else {
                $company->saveModules([]);
            }

            $data_info = $request->only('id_domovita', 'login_onliner', 'pass_onliner', 'login_realt', 'pass_realt');

            if ($company->companyInformation()->update($data_info)) {
                return ['status' => __('messages.record.update')];
            }
            return ['status' => __('messages.record.update')];
        }
        return ['error' => __('messages.error')];
    }

    public function deleteCompany($company)
    {
        //удаление модулей у компании
        if ($company->modules()->detach()) {
            return ['status' => __('messages.ban')];
        } else {
            return ['error' => __('messages.error')];
        }
    }
}
