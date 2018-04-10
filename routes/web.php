<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses'=>'Auth\LoginController@showLogin', 'as'=>'login']);
Route::get('/login', ['uses'=>'Auth\LoginController@showLogin', 'as'=>'login']);
Route::post('/login', ['uses'=>'Auth\LoginController@authenticate']);

Route::get('/logout', ['uses'=>'Auth\LoginController@logout', 'as'=>'logout']);
Route::get('/logout', ['uses'=>'Auth\LoginController@logout', 'as'=>'logout']);


//{sales}
Route::post('/sales/display',  ['uses'=>'SaleController@display', 'as'=>'sales.display']);
Route::resource('/sales', 'SaleController', ['middleware'=>'legasy_session']);

//для админки
Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'legasy_session'], function (){
    //admin
    Route::get('/', ['uses'=>'Admin\IndexController@index', 'as'=>'adminIndex']);
    //{companies}
    Route::resource('/companies', 'Admin\CompanyController');

    //{users}
    Route::post('/users/display',  ['uses'=>'Admin\UserController@display', 'as'=>'users.display']);
    Route::post('/users/{user}/ban',  ['uses'=>'Admin\UserController@ban', 'as'=>'users.ban']);
    Route::resource('/users', 'Admin\UserController');

    //{users_arch}
    Route::post('/users_arch/display',  ['uses'=>'Admin\UserArchController@display', 'as'=>'users_arch.display']);
    Route::resource('/users_arch', 'Admin\UserArchController');
    //{roles}
    Route::resource('/roles', 'Admin\PermissionController');
    //{modules}
    Route::resource('/modules', 'Admin\ModuleController');
    //{locations}
    Route::resource('/locations', 'Admin\LocationController');

});



