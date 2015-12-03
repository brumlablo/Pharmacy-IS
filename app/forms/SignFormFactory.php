<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignFormFactory extends Nette\Object
{
	/** @var User */
	private $user;


	public function __construct(User $user)
	{
		$this->user = $user;
	}

        /**
	 * @return Form
	 */
	public function create()
	{
                $test = new BootstrapForm;
		$form = $test->create();
		$form->addText('username', 'Username:')
			->setRequired('Prosím zadejte své uživatelské jméno.');

		$form->addPassword('password', 'Password:')
			->setRequired('Prosím zadejte své heslo.');

		$x=$form->addCheckbox('remember', 'Keep me signed in')
                        ->getSeparatorPrototype()->class("checkbox");
                        
                

		$form->addSubmit('send', 'Sign in');

		return $form;
	}


	

}
