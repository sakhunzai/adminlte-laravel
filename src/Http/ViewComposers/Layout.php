<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class Layout
{
    use Skins;
    protected $isGuest;
    
    public function compose($view){
       
        $this->isGuest=Auth::guest();
        
        $view->with('layout',(object)[
                    'name'=> $this->getLayout(),
                    'logoSmall'=> $this->makeTextLogo(Config('adminlte.abbr')),
                    'logoLarge'=> $this->makeTextLogo(Config('adminlte.title')),
                    'showFooter' => Config('adminlte.footer'),
                    'showSidebar' => !$this->isGuest && Config('adminlte.sidebar'),
                    'showControlSidebar' => !$this->isGuest && Config('adminlte.controlsidebar'),
                    'skinStyle'=>  'skin-'.$this->getSkin(),
                    'profileImg' => $this->profileImage(),
                    'showSideSearch' =>  false,
                    'showSideMenu' => false,
                    'headerMenus'=>Config('adminlte.headermenus'),
                    'styles'=>$this->getStyles(),
                    'scripts'=>$this->getScripts(),
                    'breadcrumbs'=>$this->getBreadCrumbs(),
                    'package'=>Config('adminlte.package'),
        ]);
    }
    
    public function getLayout()
    {
        $layout=$this->isGuest ? Config('adminlte.publiclayout') : Config('adminlte.layout');
        if(in_array($layout, Config('adminlte.layouts')))
            return $layout;
        else
            return ($this->isGuest ? 'layout-top-nav' : 'sidebar-mini');
    }
      
    public function getStyles()
    {
        $styles=Config('adminlte.assets.styles');
        $styles[]=['path'=>$this->getSkinCss(),'info'=>'AdminLTE Theme Skin'];
        $styles[]=['path'=>$this->getICheckSkinCss(),'info'=>'iCheck '];
        return $styles;
    }
    
    public function getScripts()
    {
        $scripts=Config('adminlte.assets.scripts');
        return (is_array($scripts) ? $scripts : []);
    }
    
    public function getBreadCrumbs()
    {
        if($this->isGuest) return [];
        
        return [
            ['class'=>'fa fa-dashboard','name'=>'Dashboard','link'=>'#'],
            ['class'=>'active','name'=>'Home','active'=>false],
        ];
    }    
}