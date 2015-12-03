<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Components;

use Nette;
/**
 * Description of LogoutControl
 *
 * @author hamer
 */
class LogoutControl extends Nette\Application\UI\Control{    
    
    /** @var Nette\Security\User */ 
    private $user;
    
    public function __construct(Nette\Security\User $user) {
        $this->user = $user;
    }
    
    public function render(){
        $this->template->setFile(__DIR__.'/templates/logout.latte');
        
        
        if($this->user->isLoggedIn()){
            
            $this->template->name = $this->user->getIdentity()->username;
        }
        else {
            $this->template->name = NULL;
        }
        $this->template->render();
    }
}

interface ILogoutFactory{
    /**
     * @return LogoutControl
     */
    function create();
}
    
