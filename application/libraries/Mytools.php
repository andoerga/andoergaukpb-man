<?php

class Mytools {
	
	public function encrypt_password($password){
		$salt = 'Drkguq5EvjSVTn0NzkE7T8UtjT0G';
		$crypted = md5(md5($salt.$password.$salt));
		return $crypted;
		/*
		//$salt = 'Drkguq5EvjSVTn0NzkE7T8UtjT0G';
		$options = [
			'cost' => 8,
			//'salt' => 'Drkguq5EvjSVTn0NzkE7T8UtjT0G'
		];
		$crypted = password_hash($password, PASSWORD_DEFAULT, $options);
		echo $crypted;
		return $crypted;
		*/
	}
		
}