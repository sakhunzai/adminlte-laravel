<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

trait Skins
{
    
    protected $defaultSkin='blue';
    protected $defaultICheckSkin='square';
           
    public function getSkin(){
        $skin = Config('adminlte.skin');
        return in_array($skin,Config('adminlte.skins')) ? $skin : $this->defaultSkin;
    }
               
    public function getICheckSkin(){    
        $skin = Config('adminlte.icheckSkin');
        return in_array($skin, Config('adminlte.icheckSkins')) ? $skin : $this->defaultICheckSkin;
    }   
       
    public function getICheckColor($skin)
    {
        $colorSet=['aero','blue','flat','green','grey','orange','pink','purple','red','yellow'];
        $icheckSkin=$this->getICheckSkin();
        if($this->icheckSkinHasColorSet($icheckSkin)){
            $color=Config('adminlte.icheckColor');
            if($icheckSkin==$color || array_has($colorSet,$color))
                return $color;
            else
                return $icheckSkin; 
        }else
            return $icheckSkin;
    }
    
    public function iCheckSkinHasColorSet($icheckSkin){
        return in_array($icheckSkin,['flat','line','minimal','square']);
    }

}