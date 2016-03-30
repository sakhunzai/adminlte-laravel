<?php

namespace Acacha\AdminLTETemplateLaravel;

/**
 * Class AdminLTE.
 */
class AdminLTE
{
    /**
    * Configuration file
    */
    public function getConfig(){
        return ADMINLTETEMPLATE_PATH.'/src/Config/adminlte.php';
    }
    
    public function config(){
        return [$this->getConfig() => config_path('adminlte.php')];
    }
    /**
     * Home controller copy path.
     *
     * @return array
     */
    public function homeController()
    {
        return [
            ADMINLTETEMPLATE_PATH.'/src/stubs/HomeController.stub' => app_path('Http/Controllers/HomeController.php'),
        ];
    }

    /**
     * Auth controller copy path.
     *
     * @return array
     */
    public function authController()
    {
        return [
            ADMINLTETEMPLATE_PATH.'/src/stubs/AuthController.stub' => app_path('Http/Controllers/Auth/AuthController.php'),
        ];
    }

    /**
     * Public assets copy path.
     *
     * @return array
     */
    public function publicAssets()
    {
        return [
            ADMINLTETEMPLATE_PATH.'/public/img' => public_path('img'),
            ADMINLTETEMPLATE_PATH.'/public/css' => public_path('css'),
            ADMINLTETEMPLATE_PATH.'/public/js' => public_path('js'),
            ADMINLTETEMPLATE_PATH.'/public/plugins' => public_path('plugins'),
            ADMINLTETEMPLATE_PATH.'/public/fonts' => public_path('fonts'),
        ];
    }

    /**
     * Views copy path.
     *
     * @return array
     */
    public function views()
    {
        return [ ADMINLTETEMPLATE_PATH.'/resources/views' => resource_path('views/vendor/adminlte') ] ;
    }

    /**
     * Tests copy path.
     *
     * @return array
     */
    public function tests()
    {
        return [
            ADMINLTETEMPLATE_PATH.'/tests' => base_path('tests'),
            ADMINLTETEMPLATE_PATH.'/phpunit.xml' => base_path('phpunit.xml'),
        ];
    }
    
    /**
     * Resource assets copy path.
     *
     * @return array
     */
    public function resourceAssets()
    {
        return [
            ADMINLTETEMPLATE_PATH.'/resources/assets' => base_path('resources/assets'),
            ADMINLTETEMPLATE_PATH.'/gulpfile.js' => base_path('gulpfile.js'),
            ADMINLTETEMPLATE_PATH.'/bower.json' => base_path('bower.js'),
        ];
    }
        
}
