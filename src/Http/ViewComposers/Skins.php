<?php

namespace Acacha\AdminLTETemplateLaravel\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;

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
        if($this->icheckSkinHasColorSet($skin)){
            $color=Config('adminlte.icheckColor');
            if($skin==$color || in_array($color,$colorSet))
                return $color;
            else
                return $skin; 
        }else
            return $skin;
    }
    
    public function iCheckSkinHasColorSet($icheckSkin){
        return in_array($icheckSkin,['flat','line','minimal','square']);
    }

    public function getSkinCss(){
        $style=$this->getSkin();
        return  asset('/css/admin-lte/skins/skin-'. $style .'.min.css');
    }
    
    public function getICheckSkinCss(){
        $skin=$this->getICheckSkin();
        $color=$this->getICheckColor($skin);
        return  asset('/plugins/iCheck/skins/'. $skin .'/'. $color .'.css');
    }
    
    public function getSkinStyle(){
        return 'skin-'.$this->getSkin();
    }
    
    public function getControlsideBarBg(){
        $desitiy=last(explode('-',$this->getSkin()));
        return $desitiy=='light' ? 'control-sidebar-dark' : 'control-sidebar-dark';
    } 
    
    public function profileImage()
    {
        return  url('images/'.(!Auth::guest() && Auth::user()->avatar ? Auth::user()->avatar : 'default.png'));
    }
    
    private function makeTextLogo($text)
    {
         $parts=explode('|',$text);
         $left= head($parts);
         $right= (count($parts)> 1 ? join('', array_except($parts,0)) :  '');
         
         return "<b>$left</b>$right";
    }  
}