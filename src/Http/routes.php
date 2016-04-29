<?php
/*
 * Same configuration as Laravel 5.2:
 * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
 */
Route::group(['prefix' => config('adminlte.prefix'), 'middleware' => config('adminlte.middleware')], function () {
    Route::get('/home', 'HomeController@index');

    Route::get('/', function () {
        //var_dump(AdminLTE::config());exit;
        return view(config('adminlte.welcomeView'));
    });
});

Route::group(['prefix' => config('adminlte.auth.prefix'), 'middleware' => config('adminlte.auth.middleware')], function () {
    Route::auth();
});
