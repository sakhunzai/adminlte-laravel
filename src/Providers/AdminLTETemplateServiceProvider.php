<?php

namespace Acacha\AdminLTETemplateLaravel\Providers;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Support\ServiceProvider;
use Acacha\AdminLTETemplateLaravel\Facades\AdminLTE;

/**
 * Class AdminLTETemplateServiceProvider.
 */
class AdminLTETemplateServiceProvider extends ServiceProvider
{
    use AppNamespaceDetectorTrait;

    /**
     * Register the application services.
     */
    public function register()
    {
        if (!defined('ADMINLTETEMPLATE_PATH')) {
            define('ADMINLTETEMPLATE_PATH', realpath(__DIR__.'/../../'));
        }

        if ($this->app->runningInConsole()) {
            $this->commands([\Acacha\AdminLTETemplateLaravel\Console\AdminLTE::class]);
        }

        $this->app->bind('AdminLTE', function () {
            return new \Acacha\AdminLTETemplateLaravel\AdminLTE();
        });
        
        $this->mergeConfigFrom(AdminLTE::getConfig(), 'adminlte');
               
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->defineRoutes();
        });
        $this->setViewComposers();
        $this->publishConfig();
        //$this->publishHomeController();
        //$this->changeAuthController();
        //$this->publishPublicAssets();
        $this->publishViews();
        $this->publishResourceAssets();
        $this->publishTests();
        $this->publishMigrations();
        $this->publishEventAndListeners();
    }

    /**
     * Define the AdminLTETemplate routes.
     */
    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'Acacha\AdminLTETemplateLaravel\Http\Controllers'], function () {
                require __DIR__.'/../Http/routes.php';
            });
        }
    }

    protected function setViewComposers()
    {
        $views='Acacha\AdminLTETemplateLaravel\Http\ViewComposers';
        view()->composer('adminlte::*',function($view) use($views){
            if(($view && !$view->layout)) {
                $layout=new \Acacha\AdminLTETemplateLaravel\Http\ViewComposers\Layout();
                $layout->compose($view);
            }
        });
    }
    
    /**
     * Publish configuration file
     */  
    private function publishConfig(){
        $this->publishes(AdminLTE::config(),'adminlte');
    }
    
    /**
     * Publish Home Controller.
     */
    private function publishHomeController()
    {
        $this->publishes(AdminLTE::homeController(), 'adminlte');
    }

    /**
     * Change default Laravel AuthController.
     */
    private function changeAuthController()
    {
        $this->publishes(AdminLTE::authController(), 'adminlte');
    }

    /**
     * Publish public resource assets to Laravel project.
     */
    private function publishPublicAssets()
    {
        $this->publishes(AdminLTE::publicAssets(), 'adminlte');
    }

    /**
     * Publish package views to Laravel project.
     */
    private function publishViews()
    {
        $this->loadViewsFrom(ADMINLTETEMPLATE_PATH.'/resources/views', 'adminlte');

        //I dont thing we need to publish this 
        //$this->publishes(AdminLTE::views(), 'adminlte');
    }

    /**
     * Publish package resource assets to Laravel project.
     */
    private function publishResourceAssets()
    {
        $this->publishes(AdminLTE::resourceAssets(), 'adminlte');
    }

    /**
     * Publish package tests to Laravel project.
     */
    private function publishTests()
    {
        $this->publishes(AdminLTE::tests(), 'adminlte');
    }
    
    /**
     * Publish package migrations to Laravel project.
     */
    private function publishMigrations()
    {
        $this->publishes(AdminLTE::migrations(), 'adminlte');
    }
    
    /**
     * Publish package events  and listeners to Laravel project.
     */
    private function publishEventAndListeners()
    {
        $this->publishes(AdminLTE::listeners(), 'adminlte');
    }
}
