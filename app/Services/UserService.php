<?php

namespace App\Services;

use App\Models\User;
use Auth;


class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Уменьшает коллекцию, удаляя элементы null
     *
     * @param $array
     * @return static
     */
    public function rejectArrayNull($array)
    {
        if (is_array($array)) {
            $fillter = collect($array)->reject(function ($value) {
                return $value === null;
            });
            $fillter->all();
            return $fillter;
        }
    }

    /**
     * Добавляет в массив ключ
     *
     * @param $array
     * @return array
     */
    public function reduceArray($array)
    {
        $array_result = array();
        foreach ($array as $key => $value) {
            $array_result[$key] = ['access' => $value];
        }
        return $array_result;
    }

    public function companiesToArray($companies)
    {
        $companies_array = $companies->reduce(function ($companies_array, $company) {//функция которая будет выполнена для каждого элемента
            $companies_array[$company->id] = $company->title;
            return $companies_array;
        }, ['0' => '']);

        return $companies_array;
    }

    public function usersToArray($users)
    {
        $users_array = $users->reduce(function ($users_array, $user) {//функция которая будет выполнена для каждого элемента
            $users_array[$user->id] = $user->userInformation->name;
            return $users_array;
        }, ['0' => '']);

        return $users_array;
    }

    public function rolesToArray($roles)
    {
        $role_array = $roles->reduce(function ($role_array, $role) {//функция которая будет выполнена для каждого элемента
            $role_array[$role->id] = $role->title;
            return $role_array;
        }, ['0' => '']);

        return $role_array;
    }

    /**
     * Коллекция id юзеров в массив
     *
     * @param $users
     * @return array
     */
    public function usersIdArray($users)
    {
        $users_id_array = array();
        for ($i = 0; $i < count($users); $i++) {
            array_push($users_id_array, $users[$i]->id);
        }
        return $users_id_array;
    }

    /**
     * Получение id юзеров для видимости объектов уровня
     *
     * @return array|null
     */
    public function getIdOnLevel()
    {
        if (User::getLevel() == 1) {//для уровня объекты свои (1)
            return Auth::id();
        } elseif (User::getLevel() == 2) {

            $id_manager = array();
            $manager2 = array();
            $manager_ruk = $this->user->userForManager(User::find(Auth::id())->id);

            if (count($manager_ruk) > 0) {//группа глазами руков
                foreach ($manager_ruk as $item) {
                    if ($this->user->userForManager($item->id)) {
                        $manager2 = $this->usersIdArray($this->user->userForManager($item->id));
                    }
                    array_merge($id_manager, $manager2);
                }
                array_merge($id_manager, $this->usersIdArray($manager_ruk));
                array_push($id_manager, Auth::id());//добавить себя
                return $id_manager;

            } else {//группа глазами агента
                $manager = User::find(Auth::id())->manager_id;
                $id_group = $this->usersIdArray($this->user->userForManager($manager));
                array_push($id_group, $manager);//добавить самого рука
                return $id_group;
            }

        } elseif (User::getLevel() == 3) {

            $collection_id_company = $this->user->getAllUserCompanyNoDelete(User::getCompanyId());
            return $this->usersIdArray($collection_id_company);

        } elseif (User::getLevel() == 4) {
            return null;
        }

    }


}