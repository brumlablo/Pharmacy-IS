<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
/**
 * Description of basketForm
 *
 * @author hamer
 */
class BasketForm extends Nette\Application\UI\Control{
    
    /** @var \App\Components\BasketControl @inject*/
    public $basket;
    
    
    /** @persistent */
    public $lek;
    
    public function render($lek){
        $this->lek =$lek;
        $this->template->setFile(__DIR__."/templates/basketForm.latte");
        $this->template->lek=$lek;
        //\Tracy\Debugger::dump($this);
        $this->template->render();
    }
    
    public function createComponentBasketForm()
    {
        $lek = $this->lek;
        $callback = array($this,'addToCart');
        return new \Nette\Application\UI\Multiplier(function ($id) use ($lek,$callback)
        {
            $form = new Form();

            $form->addHidden('ean', $id);
            $form->addText('count')
                ->setRequired()
                ->addRule($form::FILLED)
                ->addRule(Form::INTEGER, 'Musí být číslo')
                ->addRule(Form::RANGE, 'Musí být mezi %d a %d', array(1, $lek->pocet_ks));

            $form["add"] = new SubmitWithLabelButton("Přidat do košíku");
            //$form->addSubmit('add', 'Přidat do košíku');

            $form->onSubmit[] = $callback;
            //$form->on

            return $form;
        });
    }
    public function addToCart(Form $form)
    {
        if(! $form->isSubmitted()){
            return;
        }
        
        if(! $form->isSuccess()){
            return;
        }
        
        //$values = $form->getValues();
        //\Tracy\Debugger::barDump($values);
        \Tracy\Debugger::barDump($form);
        //$this->getPresenter()->redrawControl("table_leks");
        /*if(!$this->getPresenter()->isAjax()){
            $this->getPresenter()->redirect("Lek:");   
        }*/
        
        //$this->basket
    }
}



interface BasketFormFactory {
    /**
     * @return \App\Forms\BasketForm
     */
    function create();
}