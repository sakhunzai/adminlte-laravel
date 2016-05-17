<?php
/*
 * Same configuration as Laravel 5.2:
 * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
 */
Route::group(['prefix' => config('adminlte.prefix'), 'middleware' => config('adminlte.middleware')], function () {
    Route::auth();

    Route::get('thankyou', function () {
        //var_dump(AdminLTE::config());exit;
        return view(config('adminlte.thankyouView'));
    });

    Route::get('/', function () {
        if(config('adminlte.welcomeRedirect','')!=='')
            return redirect(config('adminlte.welcomeRedirect'));

        return view(config('adminlte.welcomeView'));
    });

    Route::get('register/verify/{verificationCode}', [
        'as' => 'verification_path',
        'uses' => 'RegistrationController@verify'
    ]);
});

Route::group(['prefix' => config('adminlte.auth.prefix'), 'middleware' => config('adminlte.auth.middleware')], function () {

    Route::get('home', config('adminlte.homeController','HomeController@index'));
        
    Route::post('profile', [
        'as' => 'profile',
        'uses' => 'HomeController@profile'
    ]);

    Route::get('images/{file}','ImageController@getImage');

});

