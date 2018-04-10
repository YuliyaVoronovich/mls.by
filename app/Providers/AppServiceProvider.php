<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // @set ($i,10)
        Blade::directive('set', function ($exp) {
            list ($name, $val) = explode(',', $exp);

            return "<?php $name = $val ?>";
        });

        DB::listen(function ($query) {//прослушивание методов всех
            //dump($query->sql);//распечатка запроса для тестирования
            // dump($query->bindings);//массив передаваемых параметров в запрос
        });

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
