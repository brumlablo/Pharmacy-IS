<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;


use Nette,
    Nette\Application\UI\Form;
/**
 * Description of LekPresenter
 *
 * @author hamer
 */
class LekPresenter extends BasePresenter{
    //put your code here
    
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault()
    {
        $this->template->leky = $this->database->table('lek');
    }
    /*
    public function renderEdit($id){
        $this->template->lek = $this->database->table('lek')->get($idLek);
    }*/

    public function renderEdit($id){
        
        $this->template->setFile(__DIR__.'/templates/Lek/edit.latte');
        $this->template->lek = $this->database->table('lek')->get($id);
        $this['lekEditForm']->setDefaults($this->template->lek);
    }
    
    public function handleEdit($idLek){      
        if($this->isAjax()){
            $this->template->setFile(__DIR__.'/templates/Lek/edit.latte');
            $this->template->lek = $this->database->table('lek')->get($idLek);
            $this['lekEditForm']->setDefaults($this->template->lek);
            $this->redrawControl("modalcontent");
        } else {
            $this->redirect("Lek:edit", $idLek);
        }
    }
    
    
    public function createComponentLekEditForm(){
        $form = $this->createBootstrapForm();
        $form->addText('ean_id',"EAN:");
        $form->addText('nazev',"Název:");
        $form->addTextArea('popis',"Popis:",0, 5)
                ->getControlPrototype()->class("form-control");
        $form->addSubmit("save", "Uložit");
        //$form->addButton("cancel", "Zrušit",new Nette\Application\Link($this, 'Lek:default'));
        
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
        return $el->class($this->getHtmlName()." btn btn-default")
                ->href($this->href)
                ->add($caption === NULL? $this->caption:$caption);
    }
}