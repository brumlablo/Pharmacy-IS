<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Components;


use Nette;
/**
 * Description of BasketControl
 *
 * @author hamer
 */
class BasketControl extends Nette\Application\UI\Control{

    /** @var Nette\Http\Session */
    private $session;

    /** @var Nette\Http\SessionSection */
    private $basket;
    private $lekDb;

    public function __construct(Nette\Http\Session $session, \App\Model\LekModel $lek)
    {
        $this->session = $session;
        $this->lekDb = $lek;
        // a získáme přístup do sekce 'mySection':
        $this->basket = $session->getSection('basket');
        //unset($this->basket->polozky);
    }
    
    public function addItem($itemId,$itemCount){
        if(isset($this->basket->items[$itemId])){
            $this->basket->items[$itemId]+=$itemCount;
        }
        else{
            $this->basket->items[$itemId] = $itemCount;
        }
    }
    
    public function getItems(){
        return $this->basket->items;
    }
    
    public function deleteItem($index){
        unset($this->basket->items[$index]);
    }
    
    public function clear(){
        unset($this->basket->items);
    }
    
    public function render(){
        $this->template->setFile(__DIR__.'/templates/basket.latte');
        
        
        
        $num = count($this->basket->items);
        $x = $num-5;
        $polozka = "Položka";
        if($x > 4){
            $polozka="Položek";
        }
        else if($x > 1){
            $polozka="Položky";
        }
        
        if($num > 0){
            $slice = array_slice($this->basket->items, 0,5,TRUE);

            $keys = array_keys($slice);


            //$this->template->items=array_slice($this->basket->items, 0,5);
            $this->template->count= $slice;
            $this->template->leky = $this->lekDb->getLekInfo($keys);
            $this->template->moreText= "a dalších ".$x." ".$polozka;
        }
        $this->template->countItems = $num;
        $this->template->polozkaText = $polozka;
        $this->template->render();
    }
}

interface IBasketFactory {
    
    /** @return BasketControl*/
    function create();
}
