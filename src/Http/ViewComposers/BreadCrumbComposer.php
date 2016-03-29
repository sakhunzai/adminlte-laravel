<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class BreadCrumbComposer
{
    public function compose($view){
        $view->with('breadcrumbs',[
            ['class'=>'fa fa-dashboard','name'=>'Dashboard','link'=>'#'],
            ['class'=>'active','name'=>'Home','active'=>false],
        ]);
    }
}