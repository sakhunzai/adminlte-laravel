<?php

return [
    'title'=>'Admin|LTE Laravel',
    'abbr' =>'A|LT',
    'app' => [
        'name' => 'Admin LTE Demo App'
     ],
    'pageTitle'=>'AdminLTE with Laravel',
    'skins' =>['black','black-light','blue','blue-light','green','green-light',
        'purple','purple-light','red','red-light','yellow','yellow-light'
     ],
    'skin' =>'blue',
    'icheckSkins'=>['flat','futurico','line','minimal','polaris','square'],
    'icheckSkin'=>'square',
    'icheckColor'=>'blue', //depending on the skin, incase invalid default will be set
    'langs' => ['en:English'], //TODO
    'lang' => 'en', //TODO multiple support languages may be expose a dropdown
    'footer' => true,
    'sidebar' => true, //show/hide
    'profileImg' => '/img/admin-lte/profile/avatar-male-1.png', //maybe img adropdown /upload option
    'profileImgDir'=> storage_path('app/uploads'),
    'socialLogin'=>false,
    'welcomeRedirect'=>'',
    'welcomeView'=>'adminlte::welcome',
    'homeView' => 'adminlte::home',
    'loginView' =>'adminlte::auth.login',
    'registerView' =>'adminlte::auth.register',
    'resetRequestView'=>'adminlte::auth.passwords.email',
    'resetView'=>'adminlte::auth.passwords.reset',
    'thankyouView' =>'adminlte::auth.thankyou',
    'termsOfService' =>'adminlte::partials.terms_of_service',
    'middleware' => ['web'],
    'prefix' => '',
    'homeController'=>'HomeController@index',
    'auth'=>[
        'login'=>[
            'redirect'=>[
                'enabled' => true,
                'handler' => 'Acacha\AdminLTETemplateLaravel\LoginRedirect'
            ]
        ],
        'middleware' => ['web', 'auth'],
        'prefix' => '',
        'loginOnlyVerifiedUsers'=>true,
        'resetLogin'=>false,
        'register'=>[
             'terms_of_service'=> true,
             'name'=> ['first_name'=>'First name','last_name' => 'Last Name'],
             'default_user_type'=> 'registered',
             'extra_fields'=>['phone'],
             'validations'=>[
                'first_name' => 'required|max:127',
                'last_name' => 'max:127',
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'terms_of_service' => 'accepted',
             ],
             'verification'=>[
                'enabled'=> true,
                'token_length'=> 30,
                'column'=>'verification_code',
                'subject'=> 'Verify your email address',
                'thankyou'=> 'Thanks for signing up! Please check your email.',
                'template'=> 'adminlte::auth.emails.verify'
             ],
            'redirect'=>[
                'autologin'=> true,
                'route'=>'thankyou'
            ]
        ],
     ]
];