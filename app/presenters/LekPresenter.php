<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;


use Nette,
    Nette\Application\UI\Form;
use App\Model;
/**
 * Description of LekPresenter
 *
 * @author hamer
 */
class LekPresenter extends BasePresenter{
    //put your code here
    /** @var Model\LekModel*/
    public $db;
    /** @var Nette\Security\User*/
    protected $user;

    public function __construct(Model\LekModel $database, Nette\Security\User $user)
    {
        $this->db = $database;
        $this->user = $user;
    }

    public function renderList(){
        $this->template->setFile(__DIR__."/templates/default.latte");
        $this->template->leky = $this->db->getLekList();
    }
    
    public function renderDefault()
    {
        $this->template->leky = $this->db->getLekListByPobocka($this->user->getIdentity()->pobocka_adresa);
    }
    /*
    public function renderEdit($id){
        $this->template->lek = $this->database->table('lek')->get($idLek);
    }*/
    public function renderNew()
    {
        
    }

    public function renderEdit($id){
        
        $this->template->setFile(__DIR__.'/templates/Lek/edit.latte');
        $this->template->lek = $this->db->getLek($id);
        $this['lekEditForm']->setDefaults($this->template->lek);
    }
    
    public function handleNew(){
        if($this->isAjax()){
            $this->template->setFile(__DIR__.'/templates/Lek/new.latte');
            $this->redrawControl("modalcontent");
        } else {
            $this->redirect("Lek:new");
        }
            
    }
    
    public function handleEdit($idLek){      
               
        if($this->isAjax()){
            $this->template->setFile(__DIR__.'/templates/Lek/edit.latte');
            $this->template->lek = $this->db->getLek($idLek);
            $this['lekForm']->setDefaults($this->template->lek);
            $this->redrawControl("modalcontent");
        } else {
            $this->redirect("Lek:edit", $idLek);
        }
    }
    
    
    public function createComponentBasketForm(){
        $presenter = $this;
        return new \Nette\Application\UI\Multiplier(function ($ean) use ($presenter)
        {
            return new \Nette\Application\UI\Multiplier(function ($max) use ($presenter,$ean) 
            {              
                $form = new Form();

                $form->addHidden('ean', $ean);
                $form->addText('count')
                    ->setRequired()
                    ->addRule($form::FILLED)
                    ->addRule(Form::INTEGER, 'Musí být číslo')
                    ->addRule(Form::RANGE, 'Musí být mezi %d a %d', array(1, $max));

                $form["add"] = new SubmitWithLabelButton("Přidat do košíku");
                //$form->addSubmit('add', 'Přidat do košíku');

                $form->onSuccess[] = array($presenter,'basketSuccess');
                //$form->on

                return $form;  
            });
        });
    }
    
    public function basketSuccess(\Nette\Application\UI\Form $form, $values) {
        \Tracy\Debugger::barDump($values);
        
        $this->basketFactory->create()->addItem($values->ean, $values->count);
        if($this->isAjax()){
            $this->getComponent("basket")->redrawControl("basket");
        } else {
            $this->redirect("Lek:");
        }
            
    }
    
    public function createComponentLekForm(){
        
        $form = $this->bootstrapForm->create();
        $form->addText('ean_id',"EAN:");
        $form->addText('nazev',"Název:");
        $form->addTextArea('popis',"Popis:",0, 5)
                ->getControlPrototype()->class("form-control");
        
        $form->addSelect("dodavatel_ico", "Dodavatel: ")       
                ->setItems($this->db->getDodavatels())         
                ->getControlPrototype()->class("form-control");
        $form->addSubmit("save", "Uložit");
        //$form->addButton("cancel", "Zrušit",new \Nette\Application\Link($this, 'Lek:default'));
        
        $form["modal_cancel"] = new CancelButton("Zrušit", $this->link("Lek:default"));
        
        $form->getElementPrototype()
                ->class('form-horizontal page-form')
                ->role('form');
        
        return $form;
    }
    
    
    
}


class CancelButton extends Nette\Forms\Controls\Button{
    
    private $href;
    
    public function __construct($caption = NULL,$href="NULL") {
        parent::__construct($caption);
        $this->href = $href;
        $this->control = Nette\Utils\Html::el('a',NULL);
    }
    
    public function getLabel($caption = NULL) {
        return NULL;
    }
    public function getControl($caption = NULL) {
        $this->setOption('rendered',TRUE);
        $el = clone $this->control;
        return $el->class(" btn btn-default")
                ->rel($this->getHtmlName())
                ->href($this->href)
                ->add($caption === NULL? $this->caption:$caption);
    }
}

class SubmitWithLabelButton extends Nette\Forms\Controls\SubmitButton{
    
    public function __construct($caption = NULL) {
        parent::__construct($caption);
    }
    
    public function getLabel($caption = NULL) {
        $label = clone $this->label;
        $label->for = $this->getHtmlId();
        $label->setText($this->translate($caption === NULL ? $this->caption : $caption));
        return $label;
    }
}