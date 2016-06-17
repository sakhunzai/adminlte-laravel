<?php

return [
    'title'=>'Admin|LTE Laravel',
    'abbr' =>'A|LT',
    'app' => [
        'name' => 'Admin LTE Demo App'
     ],
    'pageTitle'=>'AdminLTE with Laravel',
    'package'=>[
        'url'=>'https://github.com/acacha/adminlte-laravel',
        'description'=>'A Laravel 5 package that switchs default Laravel scaffolding/boilerplate to AdminLTE template',
        'company'=>[
            'name'=>'Acacha.org',
            'url'=>'http://acacha.org'
        ],
        'authors'=>[
            [
                'name'=>'Sergi Tur Badenas',
                'url'=>'http://acacha.org/sergitur',
                'repo'=>'https://github.com/acacha/adminlte-laravel'
            ],
        ]
    ],
    'skins' =>['black','black-light','blue','blue-light','green','green-light',
        'purple','purple-light','red','red-light','yellow','yellow-light'
     ],
    'skin' =>'blue',
    'layout'=>'sidebar-mini',
    'publiclayout'=>'layout-top-nav',
    'layouts'=>['fixed','layout-boxed','layout-top-nav','sidebar-collapse','sidebar-mini'],
    'icheckSkins'=>['flat','futurico','line','minimal','polaris','square'],
    'icheckSkin'=>'square',
    'icheckColor'=>'blue', //depending on the skin, incase invalid default will be set
    'langs' => ['en:English'], //TODO
    'lang' => 'en', //TODO multiple support languages may be expose a dropdown
    'footer' => true,
    'sidebar' => [
        'show'=>true, //show/hide
        'search'=> true,
        'menu'=> true,
    ],
    'controlsidebar' => true, //show/hide
    'headermenus'=>[
        'show'=>false,
        'items'=>[
            'adminlte::layouts.partials.menu.messages',
            'adminlte::layouts.partials.menu.notifications',
            'adminlte::layouts.partials.menu.tasks'
        ]
    ],
    
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
    ],
    'assets'=>[
        'styles'=>[
            ['path'=>'/css/bootstrap.min.css' ,'info'=>'Bootstrap 3.3.4'],
            ['external'=>'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' ,'info'=>'Font Awesome Icons '],
            ['external'=>'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' ,'info'=>'Ionicons'],
            ['path'=>'/css/admin-lte/AdminLTE.min.css' ,'info'=>'AdmintLTE Theme'],
            ['path'=>'/plugins/Croppie/croppie.css' ,'info'=>'Croppie Plugin'],
        ],
        'scripts'=>[
            ['path'=>'/js/jquery.min.js' ,'info'=>'jQuery 2.1.4 ','context'=>['*','auth']], 
            ['path'=>'/js/bootstrap.min.js' ,'info'=>'Bootstrap 3.3.2 JS','context'=>['*','auth']],
            ['path'=>'/js/admin-lte/AdminLTE.min.js' ,'info'=>'AdminLTE App','context'=>['*','auth']], 
            ['path'=>'/plugins/iCheck/icheck.min.js' ,'info'=>'iCheck','context'=>['auth']], 
            ['path'=>'/plugins/Croppie/croppie.js' ,'info'=>'Croppie - from image cropping','context'=>['*']]
        ],
        'shims'=>[
            [
                'condition'=>'lt IE 9',
                'scripts'=>[
                    [
                        'path'=>'/plugins/html5shiv/html5shiv.min.js' ,
                        'info'=>'HTML5 Shim IE8 support of HTML5 elements',
                        'context'=>['*'],
                    ],
                    [
                        'path'=>'/plugins/respond/respond.min.js',
                        'info'=>"Respond.js IE8 support of media queries, does not work if you view the page via file:// ",
                        'context'=>['*']
                    ]
                ]
         ]
      ],
      
    ],
];