<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class MusicSong extends Model implements Modalable {

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
	
	public static array $fieldsToPrintInForm = [
		[ 'fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'fk_album_rowid' , 'fieldnameInHtml' => 'id de l\'album' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'name' , 'fieldnameInHtml' => 'titre' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_image' , 'fieldnameInHtml' => 'chemin vesr image' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_mp3' , 'fieldnameInHtml' => 'chemin vers mp3' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'lyrics' , 'fieldnameInHtml' => 'paroles' , 'canBeDisplayed' => true , 'canBeSet' => true ]
	];

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('music_song');


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

	public function set_active(int $active_given) :bool
	{
		//--- on met la valeur à 0 si celle passée est négative , et on met à 1 si supérieur à 0 (donc 1 et au delà)
		if ($active_given <= 0)
		{
			$active_given = 0;
		} else {
			$active_given = 1;
		}

		$this->active = $active_given; 
		return true;
	}

	public function set_fk_album_rowid(int $fk_album_rowid_given) :bool
	{
		if ($fk_album_rowid_given < 0)
		{
			throw new Exception('ERREUR: $fk_album_rowid_given ne peut pas être négatif');
		}

		$this->fk_album_rowid = $fk_album_rowid_given; 
		return true;
	}

	public function set_name(string $name_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($name_given) > 50)
		{
			throw new Exception("ERREUR : le name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		/* $containAuthorizedCharactersOnly = containOnlyAuthorizedCharacters($name_given , "letters+digits+spaces+apostrophe");
		if (!$containAuthorizedCharactersOnly)
		{
			throw new Exception("ERREUR : le `nom` donné contient des caractères autres que letters+digits+spaces+apostrophe");
			;
		} */

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		// NOTE : utiliser l'un au l'autre mais pas les deux
		// $this->name = $name_given;
		$this->name = mysqli_real_escape_string($mysqli , $name_given);
		
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
		
		// REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
			$this->path_image = mysqli_real_escape_string($mysqli , $path_image_given);
			// --- si non :
			# $this->path_image = $path_image_given;
		
		return true;
	}
	
	
	public function set_path_mp3(string $path_mp3_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($path_mp3_given) > 512)
		{
			throw new Exception("ERREUR : le path_mp3 donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		// REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
			$this->path_mp3 = mysqli_real_escape_string($mysqli , $path_mp3_given);
			// --- si non :
			# $this->path_mp3 = $path_mp3_given;
		
		return true;
	}

	public function set_lyrics(string $lyrics_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		
		//--- renvoyer erreur si taille > 16000000 (normally 16777215 max for a MEDIUMTEXT)
		//LINK - https://www.mysqltutorial.org/mysql-text/
		if (strlen($lyrics_given) > 16000000)
		{
			throw new Exception("ERREUR : les paroles données sont supérieur à 16000000 caractères, la limite étant 16777215 pour un MEDIUMTEXT.");
			;
		}

		// REVIEW : activer si nécessaire
		//--- renvoi erreur si contient des caractères non-autorisés
		$listOfBadCharacters = [];
		$containBadCharacters = preg_match("/[^\w \'\_\-\"\,\.\!\?\:\;\&\(\)\r\n]/iu", $lyrics_given, $listOfBadCharacters) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : les paroles données contiennent des caractères autres que `letters+digits+spaces+apostrophe+quote+dash+underscore`. Retirer: ".implode(' ', $listOfBadCharacters));
			;
		}




		//--- REVIEW : vérifier si je dois effectivement nettoyer les paroles qui sont données dans le formulaire.
			// --- si oui :
			$this->lyrics = mysqli_real_escape_string($mysqli , $lyrics_given);
			// --- si non :
			# $this->lyrics = $lyrics_given;
		
		return true;
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
		if (!empty($this->rowid))
			$rowDatas['rowid'] = $this->rowid; 

		//--- si vide , on prend une valeur par defaut , si non vide , on le prend
		if (empty($this->active))
		{
			$rowDatas['active'] = self::$setting_musicSongActiveByDefault;
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->name))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un MusicAlbum si la propriété `name` n'est pas remplie.");
		} else {
			$rowDatas['name'] = $this->name;
		}

		if (!empty($this->path_image))
			$rowDatas['path_image'] = $this->path_image; 

		if (!empty($this->path_mp3))
			$rowDatas['path_mp3'] = $this->path_mp3; 

		if (!empty($this->lyrics))
			$rowDatas['lyrics'] = $this->lyrics;

		return $rowDatas;
	}
}


?>