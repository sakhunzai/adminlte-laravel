<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class HtmlHeader
{
    use Skins;
    
    public function compose($view){
             
        $view->with('header',(object)[
            'skinCss' => $this->getSkinCss(),
            'icheckSkinCss' =>$this->getICheckSkinCss(),
        ]);
    }
    
    private function getSkinCss(){
        return  asset('/css/admin-lte/skins/skin-'. $this->getSkin() .'.min.css');
    }
    
    private function getiCheckSkinCss(){
        $skin=$this->getICheckSkin();
        $color=$this->getICheckColor($skin);
        return  asset('/plugins/iCheck/skins/'. $skin .'/'. $color .'.css');
    }
}