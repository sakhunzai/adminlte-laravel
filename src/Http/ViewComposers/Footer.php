<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class Footer
{   
    public function compose($view){
        $view->with('footer',(object)[
            'left'=>$this->getLeftMessage(),
            'right'=>$this->getRightMessage()
        ]);
    }
    
    private function getLeftMessage(){
        return '<strong>Copyright &copy; 2015 
            <a href="http://acacha.org">Acacha.org</a>.</strong> Created by <a href="http://acacha.org/sergitur">Sergi Tur Badenas</a>. See code at <a href="https://github.com/acacha/adminlte-laravel">Github</a>';
    }
    
    private function getRightMessage(){
        return ' <a href="https://github.com/acacha/adminlte-laravel"></a><b>admin-lte-laravel</b></a>. A Laravel 5 package that switchs default Laravel scaffolding/boilerplate to AdminLTE template';
    }
}