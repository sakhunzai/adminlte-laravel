<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class MainHeader
{
    public function compose($view){
        $view->with('header',(object)[
            'logoSmall'=> $this->makeTextLogo(Config('adminlte.abbr')),
            'logoLarge'=> $this->makeTextLogo(Config('adminlte.title')),
            'profileImg' => asset(Config('adminlte.profileImg')), //default, TODO override by user profile img
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