<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Presenters;

use Nette;
/**
 * Description of KosikPresenter
 *
 * @author hamer
 */
class KosikPresenter extends BasePresenter {

    
    public function handleClear(){
        $this->basketFactory->create()->clear();
    }
    //put your code here
}
