<?php

namespace App\Presenters;

use Nette;
use App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    
    /** @var \App\Forms\BootstrapForm @inject */
    public $bootstrapForm;
    /** @var \App\Components\IMenuFactory @inject */
    public $menuControlFactory;
    /** @var \App\Components\IBasketFactory @inject */
    public $basketFactory;
    /** @var \App\Components\ILogoutFactory @inject */
    public $logoutFactory;
    
    protected function createComponentMenu(){
        $control = $this->menuControlFactory->create();
        $control->addMenuOption("Úvod","Homepage:");
        $control->addMenuOption("Lék","Lek:");
        $control->addMenuOption("Rezervace","Rezervace:");
        return $control;
    }
    
    protected function createComponentBasket(){
        $ctrl = $this->basketFactory->create();
        return $ctrl;
    }
    
    protected function createComponentLogout(){
        $logout = $this->logoutFactory->create();
        return $logout;
    }
    
    public function handleLogout(){
        $this->getUser()->logout(TRUE);
        $this->redirect("Homepage:");
    }
    
    
    public function startup() {
        parent::startup();
        if($this->getUser()->isLoggedIn()){
            return;
        }
        if($this->getName() !== "Homepage" || $this->getAction() !== "default"){
            $this->redirect("Homepage:default");
            return;
        }
    }
}