<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class Layout
{
    use Skins;
    
    public function compose($view){
        
        $view->with('layout',(object)[
            'showFooter' => Config('adminlte.footer'),
            'showSidebar' => Config('adminlte.sidebar'),
            'skinStyle'=>  'skin-'.$this->getSkin(),
        ]);
    }
    
}