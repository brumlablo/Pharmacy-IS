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
 * Description of BootstrapForm
 *
 * @author hamer
 */
class BootstrapForm {
    /**
     * @return Form
     */
    public function create($horizontal=TRUE) {
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
        
        $pt = $form->getElementPrototype()
                ->role('form');
        if($horizontal) {
            $pt->class("form-horizontal page-form");
        }

        
        return $form;
    }
}
