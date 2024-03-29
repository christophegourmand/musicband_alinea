<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/Modelable.interface.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class MusicSong extends Model implements Modelable {

	// =========================================
	// PROPERTIES
	// =========================================
	//--- field in Database
	// NOTE - rowid est défini dans la classe Model
	protected int $active;
	protected int $fk_album_rowid;
	protected string $name;
	protected string $path_image;
	protected string $path_mp3;
	protected string $lyrics;
	

	//--- field not in Database
	
	/** 
	* set 0 for inactive , 1 for active
	*/
	private static int $setting_musicSongActiveByDefault = 0;

	//--- not in database, attached to the class :
	const TABLENAME = 'music_song';
	public static string $iconHtml = '<i class="fas fa-music"></i>';
	public static string $entityNameSingular = 'Morceau';
	public static string $entityNamePlural = 'Morceaux';
	public static string $explanation = 'Morceaux : contient No d\'album, titre, lien-vers-image, lien-vers-mp3, paroles.';

	public static array $fieldsToPrintInDashboard = [
		['fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id']
		, ['fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif']
		, ['fieldnameInSql' => 'name' , 'fieldnameInHtml' => 'name']
		, ['fieldnameInSql' => 'fk_album_rowid' , 'fieldnameInHtml' => 'id album']
	];
	
	/**
	* 
	* @depreacted : You should soon use `$fieldsInfos` instead
	*/
	public static array $fieldsToPrintInForm = [
		[ 'fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'fk_album_rowid' , 'fieldnameInHtml' => 'id de l\'album' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'name' , 'fieldnameInHtml' => 'titre' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_image' , 'fieldnameInHtml' => 'chemin vesr image' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_mp3' , 'fieldnameInHtml' => 'chemin vers mp3' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'lyrics' , 'fieldnameInHtml' => 'paroles' , 'canBeDisplayed' => true , 'canBeSet' => true ]
	];

	/**
	* Each key is|must be the fieldname in database (also called column name)
	*
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
			, 'max_length' => null
		],
		'active' => [
			'fieldnameInSql' => 'active'
			, 'fieldnameInHtml' => 'actif' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'number'
			, 'phpType' => 'int'
			, 'regex' => "/[^01]/"
			, 'max_length' => null
		],
		'fk_album_rowid' => [
			'fieldnameInSql' => 'fk_album_rowid'
			, 'fieldnameInHtml' => 'id album'
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'number'
			, 'phpType' => 'int'
			, 'regex' => "/[^\d]/"
			, 'max_length' => null
		],
		'name' => [
			'fieldnameInSql' => 'name' 
			, 'fieldnameInHtml' => 'nom' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => "/[^w\s\d\-\_\'\"\,\.\;\;\(\)\!\?\]/i"
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
		'path_mp3' => [
			'fieldnameInSql' => 'path_mp3'
			, 'fieldnameInHtml' => 'chemin vers mp3'
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => null
			, 'max_length' => 512
		],
		'lyrics' => [
			'fieldnameInSql' => 'lyrics' 
			, 'fieldnameInHtml' => 'paroles'
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'textarea'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\d\s\t\'\_\-\"\,\.\!\?\:\;\&\(\)\€\r\n\/\=\+\{\}]/iu"
			, 'max_length' => 16777215
		]
	];








	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		global $mysqli;

		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('music_song');
		parent::completeFieldsInDbInfos($mysqli);

	}


	// =========================================
	// CRUD
	// =========================================
	
	public function create(Mysqli $mysqli) :bool
	{
		try {
			$rowDatas = $this->prepareRowDatas();

			self::$dbHandler->insertRow($mysqli , $this->get_tableName() , $rowDatas);
		} catch (Exception $exception) {
			throw $exception;
		}

		return true; // REVIEW : bonne manière ?
	}
	

	
	
	public function load(Mysqli $mysqli , int $rowid) : bool
	{
		//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadRow($mysqli , $this->get_tableName() , ["rowid = $rowid"]);

		//--- re-affect datas from rowDatas to each properties of this object
		$this->rowid = (int) $receivedRowDatas['rowid'];
		$this->active = (int) $receivedRowDatas['active'];
		$this->fk_album_rowid = (int) $receivedRowDatas['fk_album_rowid'];
		$this->name = (string) $receivedRowDatas['name'];
		$this->path_image = (string) $receivedRowDatas['path_image'];
		$this->path_mp3 = (string) $receivedRowDatas['path_mp3'];
		$this->lyrics = (string) $receivedRowDatas['lyrics'];
		
		return true;
	}

	public function update(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible d'updater un MusicSong si la propriété `rowid` n'est pas remplie.");
		}

		$rowDatas = $this->prepareRowDatas();
		$isUpdated = self::$dbHandler->updateRow($mysqli , $this->get_tableName() , $rowDatas , $this->rowid);
		return $isUpdated;
	}
	

	
	public function delete(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible de supprimer un album de music si la propriété `rowid` n'est pas remplie.");
		}

		$isDeleted = self::$dbHandler->deleteRow($mysqli , $this->get_tableName() , $this->rowid);

		return $isDeleted;
	}
	



	// =========================================
	// GETTERS-SETTERS
	// =========================================

	//--- Setters ----------------------------------

	public function set_active(int $value_given) :bool
	{
		$fieldname = 'active';

		//--- on met la valeur à 0 si celle passée est négative , et on met à 1 si supérieur à 0 (donc 1 et au delà)
		if ($value_given <= 0)
		{
			$value_given = 0;
		} else {
			$value_given = 1;
		}

		$this->active = $value_given; 
		return true;
	}

	public function set_fk_album_rowid(int $value_given) :bool
	{
		$fieldname = 'fk_album_rowid';

		if ($value_given < 0)
		{
			throw new Exception('ERREUR: $value_given ne peut pas être négatif');
		}

		$this->fk_album_rowid = $value_given; 
		return true;
	}

	public function set_name(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$fieldname = 'name';

		// renvoyer erreur si taille > 50
		if (strlen($value_given) > 50)
		{
			throw new Exception("ERREUR : le name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('name', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->name = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}


	public function set_path_image(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$fieldname = 'path_image';

		// renvoyer erreur si taille > 512
		if (strlen($value_given) > 512)
		{
			throw new Exception("ERREUR : le path_image donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('path_image', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
				// --- si oui :
				$this->path_image = mysqli_real_escape_string($mysqli , $value_given);
				// --- si non :
				# $this->path_image = $value_given;
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}
	
	
	public function set_path_mp3(string $path_mp3_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$fieldname = 'path_mp3';

		// renvoyer erreur si taille > 512
		if (strlen($path_mp3_given) > 512)
		{
			throw new Exception("ERREUR : le path_mp3 donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('path_mp3', $path_mp3_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
				// --- si oui :
				$this->path_mp3 = mysqli_real_escape_string($mysqli , $path_mp3_given);
				// --- si non :
				# $this->path_mp3 = $path_mp3_given;
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}

	public function set_lyrics(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$fieldname = 'lyrics';

		//--- renvoyer erreur si taille > 16000000 (normally 16777215 max for a MEDIUMTEXT)
		//LINK - https://www.mysqltutorial.org/mysql-text/
		if (strlen($value_given) > 16000000)
		{
			throw new Exception("ERREUR : les paroles données sont supérieur à 16000000 caractères, la limite étant 16777215 pour un MEDIUMTEXT.");
			;
		}

		$badCharactersResult = parent::fieldContainBadCharacters('lyrics', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->lyrics = mysqli_real_escape_string($mysqli , $value_given);
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

	public function get_fk_album_rowid() : int
	{ 
		return $this->fk_album_rowid; 
	}

	public function get_name() : string 
	{ 
		return $this->name; 
	}

	public function get_path_image() : string 
	{ 
		return $this->path_image; 
	}

	public function get_path_mp3() : string 
	{ 
		return $this->path_mp3; 
	}

	public function get_lyrics() : string 
	{ 
		return $this->lyrics;

		// TEST - pour corriger le problème d'accents
		// LINK : https://programmation-web.net/2010/11/comment-resoudre-les-problemes-daccents/
		// return iconv( 'UTF-8', 'ISO-8859-15', $this->lyrics);
	}


	// =========================================
	// METHODS
	// =========================================

	// --- sera utilisée pour `create` et pour `update`
	public function prepareRowDatas() : array    // FONCTIONNE
	{
		$rowDatas = [];
		
		//--- important : on ne vérifie pas si $this->rowid est rempli , car pour créer il sera vide, et pour updater il sera rempli.
		//--- donc je vérifie qu'il est rempli directement dans la méthode `update`.

		//--- si non vide, on prend la valeur
		if (isset($this->rowid))
			$rowDatas['rowid'] = $this->rowid; 

		//--- si vide , on prend une valeur par defaut , si non vide , on le prend
		if (! isset($this->active))
		{
			$rowDatas['active'] = self::$setting_musicSongActiveByDefault;
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (! isset($this->fk_album_rowid))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un MusicAlbum si la propriété `fk_album_rowid` n'est pas remplie.");
		} else {
			$rowDatas['fk_album_rowid'] = $this->fk_album_rowid;
		}
	
		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->name)) // NOTE: here keep `empty` and not `!isset` cause an empty string is set, but we still don't want it !
		{
			throw new Exception("ERREUR: impossible de créer ou updater un MusicAlbum si la propriété `name` n'est pas remplie.");
		} else {
			$rowDatas['name'] = $this->name;
		}

		if (isset($this->path_image))
			$rowDatas['path_image'] = $this->path_image; 

		if (isset($this->path_mp3))
			$rowDatas['path_mp3'] = $this->path_mp3; 

		if (isset($this->lyrics))
			$rowDatas['lyrics'] = $this->lyrics;

		return $rowDatas;
	}
}


?>