<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class Bio extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected int $active;
	protected string $firstname;
	protected string $lastname;
	protected string $path_image;
	protected string $description;
	protected string $job;
	
	//--- set 0 for inactive , 1 for active
	private static int $setting_bioActiveByDefault = 1;

	//--- not in database, attached to the class :
	const TABLENAME = 'bio';
	public static string $iconHtml = '<i class="fas fa-id-card"></i>';
	public static string $entityNameSingular = 'Bio';
	public static string $entityNamePlural = 'Bios';
	public static string $explanation = 'Bios : contient nom, prénom, description, et lien-vers-photo de chaque musicien.';

	public static array $fieldsToPrintInDashboard = [
		['fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id']
		, ['fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif']
		, ['fieldnameInSql' => 'firstname' , 'fieldnameInHtml' => 'prénom']
		, ['fieldnameInSql' => 'lastname' , 'fieldnameInHtml' => 'nom']
	];
	
	public static array $fieldsToPrintInForm = [
	
	];

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('bio');

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

	
	public function load(Mysqli $mysqli , int $rowid) :bool
	{
		//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadRow($mysqli , $this->get_tableName() , ["rowid = $rowid"]);

		//--- re-affect datas from rowDatas to each properties of this object
		$this->rowid = (int) $receivedRowDatas['rowid'];
		$this->active = (int) $receivedRowDatas['active'];
		$this->firstname = (string) $receivedRowDatas['firstname'];
		$this->lastname = (string) $receivedRowDatas['lastname'];
		$this->path_image = (string) $receivedRowDatas['path_image'];
		$this->description = (string) $receivedRowDatas['description'];
		$this->job = (string) $receivedRowDatas['job'];

		return true;
	}
	
	public function update(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible d'updater une bio si la propriété `rowid` n'est pas remplie.");
		}

		$rowDatas = $this->prepareRowDatas();
		$isUpdated = self::$dbHandler->updateRow($mysqli , $this->get_tableName() , $rowDatas , $this->rowid);
		return $isUpdated;
	}
	
	//--- Devrais-je ne pas demander $rowid en param ?
	public function delete(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible de supprimer une bio si la propriété `rowid` n'est pas remplie.");
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


	public function set_firstname(string $firstname_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($firstname_given) > 50)
		{
			throw new Exception("ERREUR : le firstname donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		$containBadCharacters = preg_match("/[^\w \-]/iu", $firstname_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le firstname donné contient des caractères autres que letters");
			;
		}
	
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->firstname = mysqli_real_escape_string($mysqli , $firstname_given);
		
		return true;

	}


	public function set_lastname(string $lastname_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($lastname_given) > 50)
		{
			throw new Exception("ERREUR : le lastname donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		// renvoi erreur si comporte des caractères non-autorisés
		$containBadCharacters = preg_match("/[^\w \-]/iu", $lastname_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le lastname donné contient des caractères autres que letters");
			;
		}

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->lastname = mysqli_real_escape_string($mysqli , $lastname_given);
		
		return true;
	}
	
	public function set_path_image(string $path_image_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($path_image_given) > 512)
		{
			throw new Exception("ERREUR : le path_image donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
			$this->path_image = mysqli_real_escape_string($mysqli , $path_image_given);
			// --- si non :
			# $this->path_image = $path_image_given;
		
		return true;
	}

	public function set_description(string $description_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		//--- renvoyer erreur si taille > 16000000 (normally 16777215 max for a MEDIUMTEXT)
		//LINK - https://www.mysqltutorial.org/mysql-text/

		if (strlen($description_given) > 16000000)
		{
			throw new Exception("ERREUR : le description donné est supérieur à 16000000 caractères, la limite étant 16777215 pour un MEDIUMTEXT.");
			;
		}
		
		// renvoi erreur si contient des caractères non-autorisés
		$listOfBadCharacters = [];
		$containBadCharacters = preg_match("/[^\w \'\_\-\"\,\.\!\?\:\;\&\(\)\r\n\/]/iu", $description_given, $listOfBadCharacters) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le description donné contient des caractères autres que `letters+digits+spaces+apostrophe+quote+dash+underscore`. Retirer: ".implode(' ', $listOfBadCharacters));
			;
		}
	
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)

		//--- REVIEW : vérifier si je dois effectivement nettoyer la description qui est donnée dans le formulaire.
			// --- si oui :
			$this->description = mysqli_real_escape_string($mysqli , $description_given);
			// --- si non :
			# $this->description = $description_given;

		return true;
	}


	public function set_job(string $job_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 100
		if (strlen($job_given) > 100)
		{
			throw new Exception("ERREUR : le job donné est supérieur à 100 caractères, ce qui est la limite.");
		}
		
		$listOfBadCharacters = [];
		$containBadCharacters = preg_match("/[^\w \.\,\'\_\-\"\/]/iu", $job_given) ? true : false;
		echo '<script>console.info(`line_'.__LINE__.': $listOfBadCharacters`); console.debug('.json_encode($listOfBadCharacters).');</script>'; //! DEBUG)

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR :le job donné contient des caractères autres que letters. Retirer: ".implode(' ', $listOfBadCharacters));
			
		}

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->job = mysqli_real_escape_string($mysqli , $job_given);
		
		return true;
	}


	//--- Getters ----------------------------------

	public function get_active() : int
	{ 
		return $this->active;
	}

	public function get_firstname() : string 
	{ 
		return $this->firstname; 
	}

	public function get_lastname() : string 
	{ 
		return $this->lastname; 
	}

	public function get_path_image() : string 
	{ 
		return $this->path_image; 
	}

	public function get_description() : string 
	{ 
		return $this->description; 
	}

	public function get_job() : string 
	{ 
		return $this->job; 
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
			$rowDatas['active'] = self::$setting_bioActiveByDefault; // WORKS
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->firstname))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `firstname` n'est pas remplie.");
		} else {
			$rowDatas['firstname'] = $this->firstname;
		}

		//--- si non vide, on le prend	
		if (!empty($this->lastname))
		{
			$rowDatas['lastname'] = $this->lastname;
		}

		//--- si non vide, on le prend	
		if (!empty($this->path_image))
		{
			$rowDatas['path_image'] = $this->path_image;
		}

		//--- si non vide, on le prend	
		if (!empty($this->description))
		{
			$rowDatas['description'] = $this->description;
		}

		//--- si non vide, on le prend	
		if (!empty($this->job))
		{
			$rowDatas['job'] = $this->job;
		}

		return $rowDatas;
	}
}


?>