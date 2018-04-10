<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Auth;
use App\Filters\AdminUsersFilter;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'password', 'password_first', 'session_id', 'company_id', 'role_id', 'manager_id', 'access', 'ban', 'delete_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public $timestamps = false;

    /*
     * Связь юзер-роль
     *
     */
    public function roles()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function userInformation()
    {
        return $this->hasOne('App\Models\UserInformation', 'user_id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale', 'id');
    }

    /*
    * Связь юзер-право
    *
    */

    public function userPermissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'user_permissions')->withPivot('access');
    }

    /**
     * Менеджер конкретного сотрудника
     */
    public function getManagerUser($user_id)
    {
        $manager_collection = $this->select('manager_id')->where('id', $user_id)->get()->first();

        if (!is_null($manager_collection)) {
            return $manager_collection->manager_id;
        }
        return 0;
    }

    /**
     * Проверка на менеджера и менеджера сотрудника конкретной квартиры
     */
    public function checkManager($user_id, $manager_id)
    {
        $manager = $this->getManagerUser($user_id);
        if ($manager == $manager_id) {
            return true;
        }
        if ($this->getManagerUser($manager) == $manager_id) {
            return true;
        }
        return false;
    }

    /**
     * Все сотрудники руководителя
     */
    public function userForManager($manager_id)
    {
        return $this->where('manager_id', $manager_id)->get();
    }

    /**
     * Проверка права у конкретного пользователя
     *
     * @param $permission
     * @param bool $required
     * @return bool
     */
    public function canDo($permission, $category)
    {
        if (count($this->userPermissions) > 0) {
            foreach ($this->userPermissions as $userPermission) {

                $access = $userPermission->pivot->access;

                if ($permission === $userPermission->title && $userPermission->category_id === $category && $access) {
                    return TRUE;
                } elseif ($permission === $userPermission->title && $userPermission->category_id === $category && !$access) {
                    return FALSE;
                } else {
                    return $this->canPermission($permission, $category);
                }

            }
        } else {
            return $this->canPermission($permission, $category);
        }

    }

    /**
     * Проверка конкретного права из таблицы Привилегий
     *
     * @param $permission
     * @return bool
     *
     */
    public function canPermission($permission, $category)
    {
        if (isset($this->roles)) {
            foreach ($this->roles->permissions as $perm) {
                //  foo*, foobar
                if ($permission === $perm->title && $perm->category_id === $category) {
                    return TRUE;
                }
            }
        }

    }

    /**
     * Проверка специального права пользователя
     *
     */

    public function hasUserPermission($title, $category, $require = FALSE)
    {
        if (is_array($title)) {
            foreach ($title as $userPermissionName) {
                $userPermissionName = $this->hasUserPermission($userPermissionName, $category);
                if ($userPermissionName && !$require) {
                    return TRUE;
                } else if (!$userPermissionName && $require) {
                    return FALSE;
                }
            }
            return $require;
        } else {
            foreach ($this->userPermissions as $userPermission) {
                $access = $userPermission->pivot->access;

                if ($userPermission->title == $title && $userPermission->category_id === $category && $access) {
                    return 1;//доступ есть
                } elseif ($userPermission->title == $title && $userPermission->category_id === $category  && !$access) {
                    return 0;//доступа нет
                }
            }
        }
        return 2;//доступ как в группе

    }

    /**
     * Сохранение специальных прав пользователя
     *
     */
    public function saveUserPermissions($inputUserPermissions)
    {
        if (!empty($inputUserPermissions)) {
            $this->userPermissions()->sync($inputUserPermissions);
        } else {
            $this->userPermissions()->detach();
        }

        return TRUE;
    }

    //уровень юзера
    public static function getLevel()
    {
        return self::find(Auth::id())->access;

    }
    //id компании юзера
    public static function getCompanyId()
    {
        return self::find(Auth::id())->company_id;

    }

    public function getAllUserCompanyNoDelete($company_id)
    {
        return $this->with('company', 'userInformation')
            ->where('delete_user', '<>', 1)
            ->where('company_id', $company_id)
            ->get();
    }

    public function getUserNoDelete()
    {
        return $this->with('company', 'userInformation')
            ->where('delete_user', '<>', 1)
            ->get();
    }

    public function getUserDelete()
    {
        return $this->with('company', 'userInformation')
            ->where('delete_user', 1)
            ->get();
    }

    public function getUserId($id)
    {
        return $this->with('userInformation', 'company', 'userPermissions')
            ->where('id', $id)
            ->get()
            ->first();
    }

    public function getSearchUser($request, $index)
    {
        $users = $this->with('company', 'userInformation');
        return $users = (new AdminUsersFilter($users, $request))
            ->apply()
            ->offset(config('settings.limit') * $index)
            ->limit(config('settings.limit'))
            ->get();
    }

    public function createUser($request)
    {
        $data = $request->except('_token');

        // dd($request->all());
        if (empty($data)) {
            return array('error' => __('messages.no_data'));
        }
        $data['password'] = Hash::make($request->password);
        $data['password_first'] = $request->password;
        $data['access'] = config('settings.access');

        if ($user = $this->create($data)) {
            // dd($user);
            $user->userInformation()->create($request->all());

            if (isset($request->userPermissions)) {
                $user->saveUserPermissions($request->userPermissions);
            } else {
                $user->saveUserPermissions([]);
            }

            return ['status' => __('messages.record.add')];
        }
        return ['error' => __('messages.error')];

    }

    public function updateUser($request, $user)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return array('error' => __('messages.no_data'));
        }
        $data['password'] = Hash::make($request->password);
        $data['password_first'] = $request->password;
        $data['access'] = config('settings.access');

        $request->exists('ban') ? $data['ban'] = 1 : $data['ban'] = 0;

        if ($user->fill($data)->update()) {

            $data_info = $request->only('name', 'surname', 'patronymic', 'phone1', 'phone2', 'passport', 'date_of_birth', 'photo');
            $user->userInformation()->update($data_info);

            if (isset($request->userPermissions)) {
                $user->saveUserPermissions($request->userPermissions);
            } else {
                $user->saveUserPermissions([]);
            }

            return ['status' => __('messages.record.update')];

        }
        return ['error' => __('messages.error')];

    }

    public function deleteUser($user)
    {
        //dd($user);
        if ($user->update([
            'delete_user' => 1
        ])
        ) {
            return ['status' => __('messages.record.delete')];
        } else {
            return ['error' => __('messages.error')];
        }
    }

    public function banUser($user)
    {
        //dd($user);
        if ($user->update([
            'ban' => 1,
            'session_id' => null
        ])
        ) {
            $user->saveUserPermissions([]);
            return ['status' => __('messages.ban')];
        } else {
            return ['error' => __('messages.error')];
        }
    }


}
