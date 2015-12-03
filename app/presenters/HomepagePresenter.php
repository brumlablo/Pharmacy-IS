<?php

namespace App\Presenters;

use Nette;
use App\Model;


class HomepagePresenter extends BasePresenter
{
    
    /** @var \App\Forms\SignFormFactory @inject */
    public $signForm;
    
    private $database;
    
    public function __construct(Nette\Database\Context $db) {
        $this->database = $db;
    }
    
    public function renderLogin(){
        
    }
    
    
    public function renderDefault()
    {
        $user = $this->getUser();

        if(!$user->isLoggedIn()){
            $this->template->setFile(__DIR__."/templates/Homepage/login.latte");
            return;
        }

        \Tracy\Debugger::barDump($user);
        
        //\Tracy\Debugger::barDump($user);
        $this->template->more_vole_cigan = $this->database->table('rezervace');

    }
    
    public function createComponentLogin(){
        $form = $this->signForm->create();
        
        $form->onSuccess[] = array($this, 'loginFormSucceeded');
        return $form;
    }
    
    
    public function loginFormSucceeded(\Nette\Application\UI\Form $form, $values)
    {
        if ($values->remember) {
                $this->user->setExpiration('14 days', TRUE);
        } else {
                $this->user->setExpiration('20 minutes', TRUE);
        }

        try {
                $this->user->login($values->username, $values->password);
        } catch (Nette\Security\AuthenticationException $e) {
                $form->addError($e->getMessage());
                return;
        }

        $this->redirect('Homepage:');
    }
}
