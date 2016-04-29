<?php

return [
    'title'=>'Admin|LTE Laravel',
    'abbr' =>'A|LT',
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
    'socialLogin'=>false,
    'welcomeView'=>'adminlte::welcome',
    'homeView' => 'adminlte::home',
    'loginView' =>'adminlte::auth.login',
    'registerView' =>'adminlte::auth.register',
    'resetView'=>'adminlte::auth.passwords.email',
    'auth'=>[
        'register'=>[            
             'name'=> ['first_name'=>'First name','last_name' => 'Last Name'],
             'validations'=>[
                    'first_name' => 'required|max:127',
                    'last_name' => 'max:127',
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
             ]
        ],
        'middleware' => ['web'],
        'prefix' => '',
    ],
    'middleware' => ['web', 'auth'],
    'prefix' => '',
];