<?php
class User

	// =========================================
	// PROPERTIES
	// =========================================
	private int $rowid;
	private string $login;
	private string $pass;
	private string $pass_encoded;
	private string $date_creation; // REVIEW - est-ce le bon format pour une date ?
	private string $date_last_connection; // REVIEW - est-ce le bon format pour une date ?

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
	}


	// =========================================
	// GETTERS-SETTERS
	// =========================================

	// Setters ----------------------------------
	public function setLogin (string $login_given){
		// todo : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		$this->login = $login_given;
	}
	public function setPass (string $pass_given){ 
		$this->pass = $pass_given; 
	}



	# public function setAa (){}
	# public function setAa (){}
	# public function setAa (){}
	# public function setAa (){}
	# public function setAa (){}

	// Getters ----------------------------------
	# public function getAa (){}
	# public function getAa (){}
	# public function getAa (){}
	# public function getAa (){}
	# public function getAa (){}
	# public function getAa (){}

	// =========================================
	// METHODS
	// =========================================

}


?>