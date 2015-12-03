<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;


use Nette;
/**
 * Description of RezervacePresenter
 *
 * @author hamer
 */
class RezervacePresenter extends BasePresenter{
    
    private $database;
    
    public function __construct(\Nette\Database\Context $db) {
        $this->database = $db;
      
    }
    
    public function renderDefault()
    {
        $this->template->rezervace = $this->database->table('rezervace');
    }
    
}
