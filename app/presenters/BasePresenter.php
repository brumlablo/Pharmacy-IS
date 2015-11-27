<?php

namespace App\Presenters;

use Nette;
use App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    
    /** @var \App\Menus\IMenuFactory @inject */
    public $menuControlFactory;
    
    protected function createComponentMenu(){
        $control = $this->menuControlFactory->create();
        $control->addMenuOption("Úvod","Homepage:");
        $control->addMenuOption("Lék","Lek:");
        return $control;
    }
}
