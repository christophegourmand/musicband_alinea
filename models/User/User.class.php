<?php
class User {

	// =========================================
	// PROPERTIES
	// =========================================
	private int $rowid;
	private string $login;
	private string $pass;
	private string $pass_encoded;
	private bool $active;
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
	public function setActive (string $active_given){ 
		$this->active = $active_given; 
	}

	
	# public function setAa (){}
	# public function setAa (){}
	# public function setAa (){}

	// Getters ----------------------------------
	public function getLogin () 
	{ 
		return $this->login; 
	}

	public function getPass () 
	{
		return $this->pass; 
	}

	public function getPassEncoded () 
	{ 
		return $this->pass_encoded; 
	}

	public function getActive () 
	{ 
		return $this->active; 
	}

	# public function getAa (){}
	# public function getAa (){}
	# public function getAa (){}

	// =========================================
	// METHODS
	// =========================================

	/*
	* Check if a User exist with this login.
	*
	*/
	public function loginExist(string $login)
	{
		require($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
		// global $mysqli;

		$sql_query = "SELECT u.login";
		$sql_query .= " FROM user AS u";
		$sql_query .= " WHERE u.login = '${login}'";

		$mysqli_response = $mysqli->query($sql_query);

		$mysqli_nbOfRowsReceived = $mysqli_response->num_rows;
		
		require($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

		if ($mysqli_nbOfRowsReceived > 0) {
			return true;
		} else {
			return false;
		}
	}

	/*
	* charge le user depuis la database.
	*
	*/
	public function loadFromLogin (string $login)
	{
		require($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
		
		$sql_query = "SELECT *";
		$sql_query .= " FROM user AS u";
		$sql_query .= " WHERE u.login = '${login}'";

		$mysqli_response = $mysqli->query($sql_query);

		$mysqli_nbOfRowsReceived = (int) $mysqli_response->num_rows;
		


		// si il y a plus que 1.  UPDATE : inutile de traiter ce cas car je ferai en sorte qu'un user ne puisse jamais avoir le même login qu'un autre.


		if ($mysqli_nbOfRowsReceived == 1) { // si il y a 1
	
			// recuperer les infos depuis la row récupéré vers les variables d'instance 
			$receivedUserObject = $mysqli_response->fetch_object();
			// echo '<pre>';  @var_dump($receivedUserObject);  echo '</pre>';  exit('END');    //! DEBUG


			/*  INFOS RÉCUPÉRÉES :
			public 'rowid' => string '3' (length=1)
			public 'login' => string 'nico' (length=4)
			public 'pass' => string 'nico_batterie' (length=13)
			public 'pass_encoded' => string '' (length=0)
			public 'datecreation' => string '2022-04-03 21:50:49' (length=19)
			public 'datelastconnection' => string '2022-04-03 21:50:49' (length=19)
			*/
			$this->rowid = $receivedUserObject->rowid;
			$this->login = $receivedUserObject->login;
			$this->pass = $receivedUserObject->pass;
			$this->pass_encoded = $receivedUserObject->pass_encoded;
			$this->active = $receivedUserObject->active;
			$this->date_creation = $receivedUserObject->datecreation;
			$this->date_last_connection = $receivedUserObject->datelastconnection;

			// fermer la connexion
			require($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

			return true;
		} else { // si il y a 0
			return false;
		}

	}




}


?>