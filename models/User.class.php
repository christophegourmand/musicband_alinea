<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Group.class.php");

class User extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	private bool $active;
	private string $login;
	private string $pass;
	private string $pass_encoded;
	private string $date_creation; // REVIEW - est-ce le bon format pour une date ?
	private string $date_last_connection; // REVIEW - est-ce le bon format pour une date ?
	private Group $group;

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('user');
		$this->rowDatas = []; // defined in Model.class.php
	}


	// =========================================
	// CRUD
	// =========================================

	public function create(Mysqli $mysqli)
	{
		try {
			self::$dbHandler->insertRow($mysqli , $this);
		} catch (Exception $exception) {
			throw $exception;
		}

		return true; // REVIEW : bonne manière ?
	}

	public function load(Mysqli $mysqli , int $rowid)
	{
		//--- load the row so $this->rowDatas will be full.
		self::$dbHandler->loadRow($mysqli , $this , ["rowid = $rowid"]);

		//--- re-affect datas from rowDatas to each properties of this object
		$this->rowid = (int) $this->rowDatas['rowid'];
		$this->active = (bool) $this->rowDatas['active'];
		$this->login = (string) $this->rowDatas['login'];
		$this->pass = (string) $this->rowDatas['pass'];
		$this->pass_encoded = (string) $this->rowDatas['pass_encoded'];
		$this->date_creation = (string) $this->rowDatas['date_creation'];
		$this->date_last_connection = (string) $this->rowDatas['date_last_connection'];

		// TODO : instancier une classe group puis utiliser la methode `loadRow` et passer $this->rowDatas['fk_group_rowid'] en guise de rowid pour `loadRow`.
		$groupOfUser = new Group();
		$groupOfUser->load($mysqli , $this->rowDatas['fk_group_rowid']);
		$this->group = $groupOfUser;

	}
	
	// TODO : À CODER
	public function update(Mysqli $mysqli , int $rowid)
	{
		self::$dbHandler->updateRow($mysqli , $this , ["rowid = $rowid"]);
		return true;
	}
	
	// TODO : À CODER
	public function delete(Mysqli $mysqli , int $rowid)
	{
		return "user a été deleté";
	}
	




//! ===== CI-DESSOUS : NON ADAPTÉS À Model et Modelable ========

	// =========================================
	// GETTERS-SETTERS
	// =========================================

	//--- Setters ----------------------------------
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

	
	//--- Getters ----------------------------------

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

	// =========================================
	// METHODS
	// =========================================

	/*
	* Check if a User exist with this login.
	*
	*/
	public function loginExist(Mysqli $mysqli , string $login)
	{
		$sql_query = "SELECT u.login";
		$sql_query .= " FROM user AS u";
		$sql_query .= " WHERE u.login = '${login}'";

		$mysqli_response = $mysqli->query($sql_query);

		$mysqli_nbOfRowsReceived = $mysqli_response->num_rows;
		
		if ($mysqli_nbOfRowsReceived > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	* charge le user depuis la database.
	*
	*/
	public function loadFromLogin (Mysqli $mysqli , string $login) // REVIEW: TOUJOURS UTILE ? 
	{
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

			return true;
		} else { // si il y a 0
			return false;
		}

	}
}


?>