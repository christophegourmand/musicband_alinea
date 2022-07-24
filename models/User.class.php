<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/models/Group.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class User extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected int $active;
	protected string $login;
	protected string $pass;
	protected string $pass_encoded;
	protected int $fk_group_rowid;
	protected string $date_creation; // REVIEW - est-ce le bon format pour une date ?
	protected string $date_last_connection; // REVIEW - est-ce le bon format pour une date ?
	protected string $email;

	//--- field not in Database
	private Group $group;

	//--- set 0 for inactive , 1 for active
	private static int $setting_userActiveByDefault = 1;
	private static int $setting_userGroupIdByDefault = 4;

	//--- not in database, attached to the class :
	const TABLENAME = 'user';
	public static string $iconHtml = '<i class="fas fa-user-friends"></i>';
	public static string $entityNameSingular = 'User';
	public static string $entityNamePlural = 'Users';
	public static string $explanation = 'Users (utilisateurs) : contient status-actif, login, password, pass-encoded, id-de-son-groupe, email.';

	public static array $fieldsToPrintInDashboard = [
		['fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id']
		, ['fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif']
		, ['fieldnameInSql' => 'login' , 'fieldnameInHtml' => 'login']
		, ['fieldnameInSql' => 'fk_group_rowid' , 'fieldnameInHtml' => 'No de groupe']
	];
	
	public static array $fieldsToPrintInForm = [
		[ 'fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'login' , 'fieldnameInHtml' => 'login' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'pass' , 'fieldnameInHtml' => 'password' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'pass_encoded' , 'fieldnameInHtml' => 'pass encodé' , 'canBeDisplayed' => false , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'fk_group_rowid' , 'fieldnameInHtml' => 'id du groupe' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'date_creation' , 'fieldnameInHtml' => 'créé le' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'date_last_connection' , 'fieldnameInHtml' => 'dernière connexion le' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'email' , 'fieldnameInHtml' => 'email' , 'canBeDisplayed' => true , 'canBeSet' => true ],
	];

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('user');


	}


	// =========================================
	// CRUD
	// =========================================

	// FONCTIONNE
	public function create(Mysqli $mysqli) :bool
	{
		$rowDatas = $this->prepareRowDatas();

		try {
			self::$dbHandler->insertRow($mysqli , $this->get_tableName() , $rowDatas);
		} catch (Exception $exception) {
			throw $exception;
		}

		return true; // REVIEW : bonne manière ?
	}

	
	// FONCTIONNE
	public function load(Mysqli $mysqli , int $rowid) :bool
	{
		//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadRow($mysqli , $this->get_tableName() , ["rowid = $rowid"]);

		//--- re-affect datas from rowDatas to each properties of this object
		$this->rowid = (int) $receivedRowDatas['rowid'];
		$this->active = (int) $receivedRowDatas['active'];
		$this->login = (string) $receivedRowDatas['login'];
		$this->pass = (string) $receivedRowDatas['pass'];
		$this->pass_encoded = (string) $receivedRowDatas['pass_encoded'];
		$this->fk_group_rowid = (int) $receivedRowDatas['fk_group_rowid'];
		$this->date_creation = (string) $receivedRowDatas['date_creation'];
		$this->date_last_connection = (string) $receivedRowDatas['date_last_connection'];
		$this->email = (string) $receivedRowDatas['email'];


		// TODO : instancier une classe group puis utiliser la methode `loadRow` et passer $this->rowDatas['fk_group_rowid'] en guise de rowid pour `loadRow`.
		$groupOfTheUser = new Group();
		$groupOfTheUser->load($mysqli , $this->fk_group_rowid);
		$this->group = $groupOfTheUser;

		return true;
	}
	
	// FONCTIONNE
	//--- Devrais-je ne pas demander $rowid en param ?
	public function update(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible d'updater un user si la propriété `rowid` n'est pas remplie.");
		}

		$rowDatas = $this->prepareRowDatas();
		$isUpdated = self::$dbHandler->updateRow($mysqli , $this->get_tableName() , $rowDatas , $this->rowid);
		return $isUpdated;
	}
	
	// TODO : À CODER
	//--- Devrais-je ne pas demander $rowid en param ?
	public function delete(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible de supprimer un user si la propriété `rowid` n'est pas remplie.");
		}

		$isDeleted = self::$dbHandler->deleteRow($mysqli , $this->get_tableName() , $this->rowid);

		return $isDeleted;
	}
	


	// =========================================
	// GETTERS-SETTERS
	// =========================================

	//--- Setters ----------------------------------
	public function set_active(int $active_given){
		//--- on met la valeur à 0 si celle passée est négative , et on met à 1 si supérieur à 0 (donc 1 et au delà)
		if ($active_given <= 0)
		{
			$active_given = 0;
		} else {
			$active_given = 1;
		}

		$this->active = $active_given; 
	}
	
	public function set_login(string $login_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($login_given) > 50)
		{
			throw new Exception("ERREUR : le login donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		$containBadCharacters = preg_match("/[^\w\_\-]/i", $login_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le login donné contient des caractères autres que letters+digits+dash+underscore");
			;
		}

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->login = mysqli_real_escape_string($mysqli , $login_given);
		
		return true;
	}
	
	public function set_pass(string $pass_given){ 
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($pass_given) > 50)
		{
			throw new Exception("ERREUR : le login donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		$containBadCharacters = preg_match("/[^\w\_\-\@\!\.\?\&\*\$\,\;\:\+\=]/i", $pass_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le password donné contient des caractères autres que ceux autorisés");
			;
		}

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->pass = mysqli_real_escape_string($mysqli , $pass_given);
	}
	
	public function set_pass_encoded(string $pass_encoded_given){ 
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$this->pass_encoded = mysqli_real_escape_string($mysqli , $pass_encoded_given); 
	}
	
	/**
	 * @param  int  $fk_group_rowid_given  1:webadmin 2:band_musicians 3:band_staff 4:fan
	 */
	public function set_fk_group_rowid(int $fk_group_rowid_given){ 
		if ($fk_group_rowid_given < 0)
		{
			throw new Exception("l'id du groupe donné ne peut pas être négatif");
		}

		$this->fk_group_rowid = $fk_group_rowid_given;
	}
	
	public function set_email(string $email_given){ 
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		if (strlen($email_given > 100))
		{
			throw new Exception("ERREUR : la longueur de l'email donné ne peut pas excéder 100 caractères.");
		}

		# $containAuthorizedCharactersOnly = containOnlyAuthorizedCharacters($email_given , "email");

		$containBadCharacters = preg_match("/[^\w\_\-\.\@]/i", $email_given) ? true : false;
			/*	\D  pour any non-digit character
				\_ pour underscore
				\@ pour arobase 
				etc
			*/

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : l\'email donné contient des caractères autres que letters+digits+dash+underscore+@+.");
			;
		}

		$this->email = mysqli_real_escape_string($mysqli , $email_given);
	}
	
	//--- Getters ----------------------------------

	public function get_active() : int
	{ 
		return $this->active; 
	}

	public function get_login() : string 
	{ 
		return $this->login; 
	}

	public function get_pass() : string
	{
		return $this->pass; 
	}

	public function get_pass_encoded() : string 
	{ 
		return $this->pass_encoded; 
	}

	public function get_fk_group_rowid() : int
	{ 
		return $this->fk_group_rowid;
	}

	public function get_date_creation()
	{ 
		return $this->date_creation;
	}

	public function get_date_last_connection()
	{ 
		return $this->date_last_connection;
	}

	public function get_email() : string
	{
		return $this->email; 
	}

	public function get_group() : Group
	{
		return $this->group;
	}


	// =========================================
	// METHODS
	// =========================================

	// --- sera utilisée pour `create` et pour `update`
	public function prepareRowDatas() : array    // FONCTIONNE
	{
		$rowDatas = [];
		
		/* NOTE : on ne vérifie pas si $this->rowid est rempli , car pour créer il sera vide, et pour updater il sera rempli. Donc je vérifie qu'il est rempli directement dans la méthode `update`.*/

		//--- si non vide, on prend la valeur
		if (!empty($this->rowid))
			$rowDatas['rowid'] = $this->rowid; 


		//--- si vide , on prend une valeur par defaut , si non vide , on le prend
		if (empty($this->active))
		{
			$rowDatas['active'] = self::$setting_userActiveByDefault; // WORKS
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->login))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `login` n'est pas remplie.");
		} else {
			$rowDatas['login'] = $this->login;
		}
		
		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->pass))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `pass` n'est pas remplie.");
		} else {
			$rowDatas['pass'] = $this->pass;
		}
		
		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->pass_encoded))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `pass_encoded` n'est pas remplie.");
		} else {
			$rowDatas['pass_encoded'] = $this->pass_encoded;
		}

		//--- si vide , on prend une valeur par defaut , si non vide , on le prend
		if (empty($this->fk_group_rowid)) 
		{
			$rowDatas['fk_group_rowid'] = self::$setting_userGroupIdByDefault; // WORKS
		} else {
			$rowDatas['fk_group_rowid'] = $this->fk_group_rowid;
		}

		//--- si non vide, on le prends
		if (!empty($this->date_last_connection))
		{
			$rowDatas['date_last_connection'] = $this->date_last_connection;
		}

		//--- si non vide, on le prend	
		if (!empty($this->email))
		{
			$rowDatas['email'] = $this->email;
		}

		return $rowDatas;
	}



	/*
	* Check if a User exist with this login.
	*
	*/
	public function loginExist(Mysqli $mysqli , string $login) : bool
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
	public function loadFromLogin_old(Mysqli $mysqli , string $login) // REVIEW: TOUJOURS UTILE ? 
	{
		$sql_query = "SELECT *";
		$sql_query .= " FROM user AS u";
		$sql_query .= " WHERE u.login = '${login}'";

		$mysqli_response = $mysqli->query($sql_query);

		$mysqli_nbOfRowsReceived = (int) $mysqli_response->num_rows;

		//--- si il y a plus que 1.  UPDATE : inutile de traiter ce cas car je ferai en sorte qu'un user ne puisse jamais avoir le même login qu'un autre.

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
			$this->date_creation = $receivedUserObject->date_creation;
			$this->date_last_connection = $receivedUserObject->date_last_connection;

			return true;
		} else { // si il y a 0
			return false;
		}

	}
	
	/**
	* charge le user depuis la database.
	*
	*/
	public function loadFromLogin(Mysqli $mysqli , string $login) // REVIEW: TOUJOURS UTILE ? 
	{
				//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadRow($mysqli , $this->get_tableName() , ["login = '$login'"]);

		//--- re-affect datas from rowDatas to each properties of this object
		$this->rowid = (int) $receivedRowDatas['rowid'];
		$this->active = (int) $receivedRowDatas['active'];
		$this->login = (string) $receivedRowDatas['login'];
		$this->pass = (string) $receivedRowDatas['pass'];
		$this->pass_encoded = (string) $receivedRowDatas['pass_encoded'];
		$this->fk_group_rowid = (int) $receivedRowDatas['fk_group_rowid'];
		$this->date_creation = (string) $receivedRowDatas['date_creation'];
		$this->date_last_connection = (string) $receivedRowDatas['date_last_connection'];
		$this->email = (string) $receivedRowDatas['email'];


		// TODO : instancier une classe group puis utiliser la methode `loadRow` et passer $this->rowDatas['fk_group_rowid'] en guise de rowid pour `loadRow`.
		$groupOfTheUser = new Group();
		$groupOfTheUser->load($mysqli , $this->fk_group_rowid);
		$this->group = $groupOfTheUser;

		return true;
	}

	/**
	* @param	string	$given_password		The password (in clear) who has been typped and that your want to check if correspond to its hash version stored in database;
	* @return	bool	Return if True or False , a hash version of given_password correspond to the pass_encoded stored in database
	*
	*/
	public function passwordCorrespondToHash(string $given_password):bool
	{
		if (empty($this->pass_encoded))
		{
			throw new Exception("ERREUR: impossible de vérifier la correspondance entre password et son hash si la propriété `pass_encoded` n'est pas remplie.");
		}

		$passwordCorrespondToHash = password_verify($given_password, $this->pass_encoded);
		return $passwordCorrespondToHash;
	}
}


?>