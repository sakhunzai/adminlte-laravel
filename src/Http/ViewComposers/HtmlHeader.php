<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;

class HtmlHeader
{
    use Skins;
    
    public function compose($view)
    {
        
        $view->with('header',(object)[
            'skinCss' => $this->getSkinCss(),
            'icheckSkinCss' =>$this->getICheckSkinCss(),
        ]);
    }
}