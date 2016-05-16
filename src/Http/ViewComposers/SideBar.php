<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class SideBar
{
    public function compose($view){
        $view->with('sidebar',(object)[
            'profileImg' => url('images/'.(Auth::user()->avatar ? Auth::user()->avatar : 'default.png'))
        ]);
    }
    
}