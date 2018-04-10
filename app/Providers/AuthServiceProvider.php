<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Sale;
use App\Policies\SalePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Sale::class => SalePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('ACCESS_ADMIN', function (User $user) {
            return $user->canDo('Доступ', config('constants.category_admin'));
        });
        Gate::define('ACCESS_OBJECTS', function (User $user) {
            return ($user->canDo('Доступ', config('constants.category_sales')) && $user->company->hasModule('Продажи'));
        });
        Gate::define('ARCH_OBJECTS', function (User $user) {
            return ($user->canDo('Просмотр архива', config('constants.category_sales')) && $user->company->hasModule('Продажи'));
        });
       /* Gate::define('ACCESS_CLIENT', function (User $user) {
            return ($user->canDo('Доступ', config('constants.category_client_sales')) && $user->company->hasModule('Продажи'));
        });*/
    }


}
