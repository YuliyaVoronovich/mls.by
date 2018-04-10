<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Доступ для админа разрешен
     */
    public function before(User $user)
    {
        if ($user->roles->title == 'Админ') return true;

    }

    //возможность редактирования от прав и принадлежности объекта
    public function edit(User $user, Sale $sale)
    {
        //все
        if ($user->canDo('Все',config('constants.category_edit_sales'))) {
            return true;
        }
        //пустые
        if ($sale->user_id == 0 && $user->canDo('Пустые',config('constants.category_edit_sales'))) {
            return true;
        }
        //свои
        if ($user->id == $sale->user_id && $user->canDo('Свои',config('constants.category_edit_sales'))) {
            return true;
        }
        //группы
        if ($user->checkManager($sale->user_id, $user->id) && $user->canDo('Группы',config('constants.category_edit_sales'))) {
            return true;
        }

        return false;

    }
    //возможность удаления от прав и принадлежности объекта
    public function delete(User $user, Sale $sale)
    {
        //все
        if ($user->canDo('Все',config('constants.category_delete_sales'))) {
            return true;
        }
        //пустые
        if ($sale->user_id == 0 && $user->canDo('Пустые',config('constants.category_delete_sales'))) {
            return true;
        }
        //свои
        if ($user->id == $sale->user_id && $user->canDo('Свои',config('constants.category_delete_sales'))) {
            return true;
        }
        //группы
        if ($user->checkManager($sale->user_id, $user->id) && $user->canDo('Группы',config('constants.category_delete_sales'))) {
            return true;
        }

        return false;

    }
    public function create(User $user)
    {
        return ($user->canDo('Возможность добавления', config('constants.category_sales')) && $user->company->hasModule('Продажи'));
    }
}


