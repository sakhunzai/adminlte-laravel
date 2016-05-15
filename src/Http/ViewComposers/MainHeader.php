<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class MainHeader
{
    public function compose($view){
        $view->with('header',(object)[
            'logoSmall'=> $this->makeTextLogo(Config('adminlte.abbr')),
            'logoLarge'=> $this->makeTextLogo(Config('adminlte.title')),
            'profileImg' => '/images/'.(Auth::user()->avatar ? Auth::user()->avatar : 'default.png'),
            'showSidebar' => Config('adminlte.sidebar'),
        ]);
    }
          
    private function makeTextLogo($text)
    {
         $parts=explode('|',$text);
         $left= head($parts);
         $right= (count($parts)> 1 ? join('', array_except($parts,0)) :  '');
         
         return "<b>$left</b>$right";
    }
    
}