<?php
/*
 * Same configuration as Laravel 5.2:
 * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
 */
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('thankyou', function () {
        //var_dump(AdminLTE::config());exit;
        return view(config('adminlte.thankyouView'));
    });

    Route::get('/', function () {
        return view(config('adminlte.welcomeView'));
    });

    Route::get('register/verify/{verificationCode}', [
        'as' => 'verification_path',
        'uses' => 'RegistrationController@verify'
    ]);
});


