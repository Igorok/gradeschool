<?php

/**
 * UserIdentity represents the data needed to identity a Useradmin.
 * It contains the authentication method that checks if the provided
 * data can identity the Useradmin.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a Useradmin.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=Useradmin::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}