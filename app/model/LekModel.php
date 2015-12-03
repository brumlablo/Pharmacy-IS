<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

/**
 * Description of LekModel
 *
 * @author hamer
 */
class LekModel extends BaseModel{
    
    public function getLekList(){
        return $this->database->table("lek");
    }
    
    public function getLek($id){
        return $this->database->table("lek")->get($id);
    }
    
    public function getLekByPobocka($pobocka,$lek){
        return $this->database->table("lek")
                ->select("lek.*,:skladPolozka.pocet_ks")
                ->where(':skladPolozka.pobocka_adresa', $pobocka)
                ->get($lek);
    }
    
    public function getLekInfo(array $keys){
        return $this->database->table("lek")
                ->where("ean_id",$keys);
    }
    
    public function getLekListByPobocka($pobocka){
        return $this->database->table("lek")
                ->select("lek.*,:skladPolozka.pocet_ks")
                ->where(':skladPolozka.pobocka_adresa', $pobocka);
    }       /*
    public function getLekListByPobocka($pobocka){
        return $this->database->table("lek")
                ->select("lek.*,:skladPolozka.pocet_ks");
                //->where(':skladPolozka.pobocka_adresa', $pobocka);
    }       */
    
    public function getDodavatels(){
        return $this->database->table('dodavatel')
                        ->select('ico, nazev')
                        ->order('nazev ASC')
                        ->fetchPairs('ico', 'nazev');
    }
    
}
