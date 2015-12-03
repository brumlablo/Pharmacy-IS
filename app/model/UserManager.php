<?php

namespace App\Model;

use Nette;
use Nette\Security\Passwords;


/**
 * Users management.
 */
class UserManager extends BaseModel implements Nette\Security\IAuthenticator
{
    
    
    const
            SALT = 'totoJEart_',
            TABLE_NAME = 'uzivatele',
            COLUMN_ID = 'id',
            COLUMN_NAME = 'username',
            COLUMN_PASSWORD_HASH = 'password',
            COLUMN_ROLE = 'role';

	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
    public function authenticate(array $credentials)
    {

        list($username, $password) = $credentials;

        $row = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();


        \Tracy\Debugger::barDump($row,"Login");


        if (!$row) {
                throw new Nette\Security\AuthenticationException('Uživatel neexistuje.', self::IDENTITY_NOT_FOUND);
        } elseif (hash("sha512", self::SALT.$password) != $row[self::COLUMN_PASSWORD_HASH]) {
                throw new Nette\Security\AuthenticationException('Heslo je nesprávné.', self::INVALID_CREDENTIAL);
        } 
        
        

        $arr = $row->toArray();
        unset($arr[self::COLUMN_PASSWORD_HASH]);
        return new Nette\Security\Identity($row[self::COLUMN_ID], $row[self::COLUMN_ROLE], $arr);
    }


	/**
	 * Adds new user.
	 * @param  string
	 * @param  string
	 * @return void
        */
    public function add($username, $password)
    {
        try {
            $this->database->table(self::TABLE_NAME)->insert(array(
                self::COLUMN_NAME => $username,
                self::COLUMN_PASSWORD_HASH => hash("sha512",  self::SALT.$password),
            ));
        } catch (Nette\Database\UniqueConstraintViolationException $e) {
            throw new DuplicateNameException;
        }
    }

}



class DuplicateNameException extends \Exception
{}
