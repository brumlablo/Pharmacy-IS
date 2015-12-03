<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette;
/**
 * Description of BaseModel
 *
 * @author hamer
 */
abstract class BaseModel extends Nette\Object {
    
    /** @var Nette\Database\Context*/
    protected $database;
    
    public function __construct(Nette\Database\Context $database){
        $this->database = $database;
    }
}
