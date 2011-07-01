<?php
require_once('phpass-0.3/PasswordHash.php');

class Password 
{
	var $hasher;
	
	function __construct()
	{
		// 8 is the hash strength.  A larger value can be used for extra security.
		// TRUE makes the passwords portable.  FALSE is much more secure.
		$this->hasher = new PasswordHash(8, TRUE);
	}
	
	function hash($pass)
	{
		return $this->hasher->HashPassword($pass);
	}
	
	function check_password($pass, $hash)
	{
		return $this->hasher->CheckPassword($pass, $hash);
	}
}
