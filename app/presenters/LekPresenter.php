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
}
