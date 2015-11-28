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
    
    
    protected function createBootstrapForm(){
        $form = new Nette\Application\UI\Form;
        $renderer = $form->getRenderer();
        
        $renderer->wrappers['controls']['container'] = NULL;
        $renderer->wrappers['pair']['container'] = 'div class=form-group';
        $renderer->wrappers['pair']['.error'] = 'has-error';
        $renderer->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
        $renderer->wrappers['control'] = array(
		'container' => 'div class=col-sm-9',
		'.odd' => NULL,

		'description' => 'span class=help-block',
		'requiredsuffix' => '',
		'errorcontainer' => 'span class=help-block',
		'erroritem' => '',

		'.required' => 'required',
		'.text' => 'form-control',
		'.password' => 'form-control',
		'.file' => 'text',
		'.submit' => "btn btn-success",
		'.image' => 'imagebutton',
		'.button' => "btn btn-default",
	);
        
        $form->getElementPrototype()
                ->class('form-horizontal page-form')
                ->role('form');
        return $form;
        
    }
}
