<?php
/**
 * Created by PhpStorm.
 * User: Юлия
 * Date: 28.03.2018
 * Time: 13:44
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer([
            config('settings.theme') . '.sales.sale_create_content',
            config('settings.theme') . '.sales.sale_show_content',
            config('settings.theme') . '.sales.index'],
            'App\Http\ViewComposers\SalesComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

}