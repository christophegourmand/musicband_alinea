<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class Bio extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected int $active;
	protected string $job;
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
		, ['fieldnameInSql' => 'job' , 'fieldnameInHtml' => 'prénom']
		, ['fieldnameInSql' => 'lastname' , 'fieldnameInHtml' => 'nom']
	];
	
	/**
	* 
	* @depreacted : You should soon use `$fieldsInfos` instead
	*/
	public static array $fieldsToPrintInForm = [
		[ 'fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'job' , 'fieldnameInHtml' => 'prénom' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'lastname' , 'fieldnameInHtml' => 'nom' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_image' , 'fieldnameInHtml' => 'chemin vers image' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'description' , 'fieldnameInHtml' => 'description' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'job' , 'fieldnameInHtml' => 'rôle' , 'canBeDisplayed' => true , 'canBeSet' => true ]
	];

	/**
	* NOTE : some other keys will be filled for each field:
	*  	'required' => will be filled by a function
	*  	'getter_method_name'
	* 	'idAttribute'
	* 	'nameAttribute'
	*/
	public static array $fieldsInfos = [
		'rowid' => [
			'fieldnameInSql' => 'rowid' 
			, 'fieldnameInHtml' => 'id' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => false
			, 'htmlInputType' => 'number'
			, 'phpType' => 'int'
			, 'regex' => "/[^\d]/"
		],
		'active' => [
			'fieldnameInSql' => 'active' 
			, 'fieldnameInHtml' => 'actif' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'number'
			, 'phpType' => 'int'
			, 'regex' => "/[^01]/"
		],
		'job' => [
			'fieldnameInSql' => 'job' 
			, 'fieldnameInHtml' => 'prénom' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\s\-]/iu" // NOTE : keep the `space`  between `\w` and `\-`
			// NOTE: `/[^\w]/iu` let pass `_` , so the only way to let pass only all letters would be `/[^a-zA-Zàèéêëîïôöùûüçà-]/iu`
			, 'max_length' => 50
		],
		'lastname' => [
			'fieldnameInSql' => 'lastname' 
			, 'fieldnameInHtml' => 'nom' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\s\-]/iu" // NOTE : keep the `space`  between `\w` and `\-`
			, 'max_length' => 50
		],
		'path_image' => [
			'fieldnameInSql' => 'path_image' 
			, 'fieldnameInHtml' => 'chemin vers image' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => null
			, 'max_length' => 512
		],
		'description' => [
			'fieldnameInSql' => 'description' 
			, 'fieldnameInHtml' => 'description' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'textarea'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\s\'\_\-\"\,\.\!\?\:\;\&\(\)\r\n\/]/iu"
			, 'max_length' => 16777215
		],
		'job' => [
			'fieldnameInSql' => 'job' 
			, 'fieldnameInHtml' => 'role' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\s\.\,\;\'\_\-\"\/]/iu"
			, 'max_length' => 100
		]
	];


	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		global $mysqli;

		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('bio');

		parent::completeFieldsInDbInfos($mysqli);

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
		$this->job = (string) $receivedRowDatas['job'];
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


	public function set_job(string $job_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($job_given) > 50)
		{
			throw new Exception("ERREUR : le job donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}

		$badCharactersResult = parent::fieldContainBadCharacters('job', $job_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->job = mysqli_real_escape_string($mysqli , $job_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}

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
		
		$badCharactersResult = parent::fieldContainBadCharacters('lastname', $lastname_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->lastname = mysqli_real_escape_string($mysqli , $lastname_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}	
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

		$badCharactersResult = parent::fieldContainBadCharacters('path_image', $path_image_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->path_image = mysqli_real_escape_string($mysqli , $path_image_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
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
		
		$badCharactersResult = parent::fieldContainBadCharacters('description', $description_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->description = mysqli_real_escape_string($mysqli , $description_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}

	//--- Getters ----------------------------------

	public function get_active() : int
	{ 
		return $this->active;
	}

	public function get_job() : string 
	{ 
		return $this->job; 
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

	// =========================================
	// METHODS
	// =========================================

	// --- sera utilisée pour `create` et pour `update`
	public function prepareRowDatas() : array    // FONCTIONNE
	{
		$rowDatas = [];
		
		/* NOTE : on ne vérifie pas si $this->rowid est rempli , car pour créer il sera vide, et pour updater il sera rempli. Donc je vérifie qu'il est rempli directement dans la méthode `update`.*/

		//--- si non vide, on prend la valeur
		if (isset($this->rowid))
			$rowDatas['rowid'] = $this->rowid; 


		//--- si vide , on prend une valeur par defaut , si non vide , on le prend
		if (! isset($this->active))
		{
			$rowDatas['active'] = self::$setting_bioActiveByDefault; // WORKS
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->job)) // NOTE: here keep `empty` and not `!isset` cause an empty string is set, but we still don't want it !
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `job` n'est pas remplie.");
		} else {
			$rowDatas['job'] = $this->job;
		}

		//--- si non vide, on le prend	
		if (isset($this->lastname))
		{
			$rowDatas['lastname'] = $this->lastname;
		}

		//--- si non vide, on le prend	
		if (isset($this->path_image))
		{
			$rowDatas['path_image'] = $this->path_image;
		}

		//--- si non vide, on le prend	
		if (isset($this->description))
		{
			$rowDatas['description'] = $this->description;
		}

		//--- si non vide, on le prend	
		if (isset($this->job))
		{
			$rowDatas['job'] = $this->job;
		}

		return $rowDatas;
	}
}


?>