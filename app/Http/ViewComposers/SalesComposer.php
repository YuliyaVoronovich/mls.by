<?php

namespace App\Http\ViewComposers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\SalesService;
use App\Services\UserService;

class SalesComposer
{
    protected $user_service;
    protected $service;
    protected $user;

    public function __construct(UserService $user_service, SalesService $service, User $user)
    {
       $this->user_service = $user_service;
       $this->service = $service;
       $this->user = $user;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $regions_array = $this->service->regionsToArray();
        $metro_array = $this->service->metroToArray();
        $wc_array = $this->service->labelsToArray('SalesWc');
        $walls_array = $this->service->labelsToArray('SalesWalls');
        $balconies_array = $this->service->labelsToArray('SalesBalconies');//?
        $terraces_array = $this->service->labelsToArray('SalesTerraces');
        $levels_array = $this->service->labelsToArray('SalesLevels');
        $types_array = $this->service->labelsToArray('SalesTypeHouses');
        $repair_array = $this->service->labelsToArray('SalesRepair');//?
        $floors_array = $this->service->labelsToArray('SalesFloors');
        $furniture_array = $this->service->labelsToArray('SalesFurniture');
        $owns_array = $this->service->labelsToArray('SalesOwns');//?
        $sales_array = $this->service->labelsToArray('SalesTermSales');
        $source_array = $this->service->labelsToArray('SalesSource');

        $users_company = $this->user_service->usersToArray($this->user->getAllUserCompanyNoDelete(User::find(Auth::id())->company_id));

        $view->with([
            'regions' => $regions_array,
            'metro' => $metro_array,
            'wc' => $wc_array,
            'walls' => $walls_array,
            'balconies' => $balconies_array,
            'terraces' => $terraces_array,
            'levels' => $levels_array,
            'types' => $types_array,
            'repairs' => $repair_array,
            'floors' => $floors_array,
            'furnitures' => $furniture_array,
            'owns' => $owns_array,
            'sales' => $sales_array,
            'sources' => $source_array,
            'users' => $users_company,
        ]);
    }

}