<?php

namespace App\Presenters;

use Nette;
use App\Model;


class HomepagePresenter extends BasePresenter
{
    private $database;
    
    public function __construct(Nette\Database\Context $db) {
        $this->database = $db;
    }
    
    
	public function renderDefault()
	{
            $this->template->more_vole_cigan = $this->database->table('rezervace');
            
            //$this->template->books = $this->database->table('book')->limit(2);
                        /*
            foreach ($books as $book) {
               echo 'title:      ' . $book->title;

               echo 'leky: ';
               foreach ($book->related('book_tag') as $bookTag) {
                   echo $bookTag->tag->name . ', ';
               }
           }   */
	}

}
