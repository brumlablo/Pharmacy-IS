<?php

namespace App\Menus;


use Nette;
/**
 * Description of MenuControl
 *
 * @author Rogell
 */
class MenuControl extends Nette\Application\UI\Control{
    
    private $menu = array();
    
    public function addMenuOption($menuName,$menuLink){
        $this->menu[] = array($menuName,$menuLink);
    }
    
    public function render(){
        $this->template->setFile(__DIR__.'/menu.latte');
        
        $this->template->menu = $this->menu;
        
        $this->template->render();
    }
}

interface IMenuFactory{
    
    /** @return MenuControl*/
    function create();
}
