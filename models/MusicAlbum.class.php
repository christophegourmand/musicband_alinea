<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");


class MusicAlbum extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	//--- field in Database
	// NOTE - rowid est défini dans la classe Model
	protected int $active;
	protected string $name;
	protected string $path_image;
	protected string $link_spotify;
	protected string $link_applemusic;
	protected string $link_itunes;
	protected string $link_deezer;
	protected string $link_amazonmusic;
	protected string $link_googleplay;
	protected string $link_tidal;

	//--- field not in Database
	
	/**
	* contain instances of class MusicSongs
	*/
	private array $musicSongs;
	
	/** 
	* set 0 for inactive , 1 for active
	*/
	private static int $setting_musicAlbumActiveByDefault = 0;

	//--- not in database, attached to the class :
	const TABLENAME = 'music_album';
	public static string $iconHtml = '<i class="fas fa-compact-disc"></i>';
	public static string $entityNameSingular = 'Album';
	public static string $entityNamePlural = 'Albums';
	public static string $explanation = 'Albums : contient titre, lien-vers-image, liens vers plateformes d\'écoute.';

	public static array $fieldsToPrintInDashboard = [
		['fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id']
		, ['fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif']
		, ['fieldnameInSql' => 'name' , 'fieldnameInHtml' => 'nom de l\'album']
		# , ['fieldnameInSql' => 'path_image' , 'fieldnameInHtml' => 'chemin vers image']
	];
	
	/**
	* 
	* @depreacted : You should soon use `$fieldsInfos` instead
	*/
	public static array $fieldsToPrintInForm = [
		[ 'fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'name' , 'fieldnameInHtml' => 'nom' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_image' , 'fieldnameInHtml' => 'chemin vers image' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_spotify' , 'fieldnameInHtml' => 'lien spotify' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_applemusic' , 'fieldnameInHtml' => 'lien applemusic' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_itunes' , 'fieldnameInHtml' => 'lien itunes' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_deezer' , 'fieldnameInHtml' => 'lien deezer' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_amazonmusic' , 'fieldnameInHtml' => 'lien amazonmusic' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_googleplay' , 'fieldnameInHtml' => 'lien googleplay' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'link_tidal' , 'fieldnameInHtml' => 'lien tidal' , 'canBeDisplayed' => true , 'canBeSet' => true ]
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
		],
		'active' => [
			'fieldnameInSql' => 'active' 
			, 'fieldnameInHtml' => 'actif' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'number'
			, 'phpType' => 'int'
		],
		'name' => [
			'fieldnameInSql' => 'name' 
			, 'fieldnameInHtml' => 'nom' 
			, 'canBeDisplayed' => true 
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
		],
		'path_image' => [
			'fieldnameInSql' => 'path_image' 
			, 'fieldnameInHtml' => 'chemin vers image' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
		],
		'link_spotify' => [
			'fieldnameInSql' => 'link_spotify' 
			, 'fieldnameInHtml' => 'lien spotify' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		],
		'link_applemusic' => [
			'fieldnameInSql' => 'link_applemusic' 
			, 'fieldnameInHtml' => 'lien applemusic' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		],
		'link_itunes' => [
			'fieldnameInSql' => 'link_itunes' 
			, 'fieldnameInHtml' => 'lien itunes' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		],
		'link_deezer' => [
			'fieldnameInSql' => 'link_deezer' 
			, 'fieldnameInHtml' => 'lien deezer' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		],
		'link_amazonmusic' => [
			'fieldnameInSql' => 'link_amazonmusic' 
			, 'fieldnameInHtml' => 'lien amazonmusic' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		],
		'link_googleplay' => [
			'fieldnameInSql' => 'link_googleplay' 
			, 'fieldnameInHtml' => 'lien googleplay' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		],
		'link_tidal' => [
			'fieldnameInSql' => 'link_tidal' 
			, 'fieldnameInHtml' => 'lien tidal' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'url'
			, 'phpType' => 'string'
		]		
	];

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		global $mysqli;
		
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('music_album');
		parent::completeFieldsInDbInfos($mysqli);
		
		$this->musicSongs = [];


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
		$this->name = (string) $receivedRowDatas['name'];
		$this->path_image = (string) $receivedRowDatas['path_image'];
		$this->link_spotify = (string) $receivedRowDatas['link_spotify'];
		$this->link_applemusic = (string) $receivedRowDatas['link_applemusic'];
		$this->link_itunes = (string) $receivedRowDatas['link_itunes'];
		$this->link_deezer = (string) $receivedRowDatas['link_deezer'];
		$this->link_amazonmusic = (string) $receivedRowDatas['link_amazonmusic'];
		$this->link_googleplay = (string) $receivedRowDatas['link_googleplay'];
		$this->link_tidal = (string) $receivedRowDatas['link_tidal'];


		// TODO : instancier une classe MusicSong puis utiliser la methode `loadRows` pour récupérer un array indexé contenant la rowDatas de chaque $musicSong.
		
		return true;
	}



	public function update(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible d'updater un MusicAlbum si la propriété `rowid` n'est pas remplie.");
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

	/* public function set_rowid(int $given_rowid) :void
	{
		$this->rowid = $given_rowid;
	} */

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
	
	public function set_name(string $name_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		//--- check if size is under limit of sql field
		if (strlen($name_given) > 50)
		{
			throw new Exception("ERREUR : le name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
/* 		//--- check if doesnt contain bad characters
		$containAuthorizedCharactersOnly = containOnlyAuthorizedCharacters($name_given , "letters+digits+spaces+apostrophe");
		if (!$containAuthorizedCharactersOnly)
		{
			throw new Exception("ERREUR : le name donné contient des caractères autres que letters+digits+spaces+apostrophe");
			;
		} */

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
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
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
			$this->path_image = mysqli_real_escape_string($mysqli , $path_image_given);
			// --- si non :
			# $this->path_image = $path_image_given;
		
		return true;
	}

	public function set_link_spotify(string $link_spotify_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_spotify_given) > 512)
		{
			throw new Exception("ERREUR : le link_spotify donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_spotify = mysqli_real_escape_string($mysqli , $link_spotify_given);
			// --- si non :
			$this->link_spotify = $link_spotify_given;
		
		return true;
	}

	public function set_link_applemusic(string $link_applemusic_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_applemusic_given) > 512)
		{
			throw new Exception("ERREUR : le link_applemusic donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_applemusic = mysqli_real_escape_string($mysqli , $link_applemusic_given);
			// --- si non :
			$this->link_applemusic = $link_applemusic_given;
		
		return true;
	}

	public function set_link_itunes(string $link_itunes_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_itunes_given) > 512)
		{
			throw new Exception("ERREUR : le link_itunes donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_itunes = mysqli_real_escape_string($mysqli , $link_itunes_given);
			// --- si non :
			$this->link_itunes = $link_itunes_given;
		
		return true;
	}

	public function set_link_deezer(string $link_deezer_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_deezer_given) > 512)
		{
			throw new Exception("ERREUR : le link_deezer donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_deezer = mysqli_real_escape_string($mysqli , $link_deezer_given);
			// --- si non :
			$this->link_deezer = $link_deezer_given;
		
		return true;
	}
	
	public function set_link_amazonmusic(string $link_amazonmusic_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_amazonmusic_given) > 512)
		{
			throw new Exception("ERREUR : le link_amazonmusic donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_amazonmusic = mysqli_real_escape_string($mysqli , $link_amazonmusic_given);
			// --- si non :
			$this->link_amazonmusic = $link_amazonmusic_given;
		
		return true;
	}
	
	public function set_link_googleplay(string $link_googleplay_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_googleplay_given) > 512)
		{
			throw new Exception("ERREUR : le link_googleplay donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_googleplay = mysqli_real_escape_string($mysqli , $link_googleplay_given);
			// --- si non :
			$this->link_googleplay = $link_googleplay_given;
		
		return true;
	}
	
	public function set_link_tidal(string $link_tidal_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($link_tidal_given) > 512)
		{
			throw new Exception("ERREUR : le link_tidal donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->link_tidal = mysqli_real_escape_string($mysqli , $link_tidal_given);
			// --- si non :
			$this->link_tidal = $link_tidal_given;
		
		return true;
	}
	

	
	//--- Getters ----------------------------------

	public function get_active() : int
	{ 
		return $this->active; 
	}

	public function get_name() : string 
	{ 
		return $this->name; 
	}

	public function get_path_image() : string 
	{ 
		return $this->path_image; 
	}

	public function get_link_spotify() : string 
	{ 
		return $this->link_spotify; 
	}

	public function get_link_applemusic() : string 
	{ 
		return $this->link_applemusic; 
	}

	public function get_link_itunes() : string 
	{ 
		return $this->link_itunes; 
	}

	public function get_link_deezer() : string 
	{ 
		return $this->link_deezer; 
	}

	public function get_link_amazonmusic() : string 
	{ 
		return $this->link_amazonmusic; 
	}

	public function get_link_googleplay() : string 
	{ 
		return $this->link_googleplay; 
	}

	public function get_link_tidal() : string 
	{ 
		return $this->link_tidal; 
	}

	/**
	* @return 	array 	Renvoi ce qui est stocké dans la propriété musicSongs , mais une autre méthode les récupère
	* @see 		Voir aussi load_musicSongs()
	*/
	public function get_musicSongs() : array
	{
		return $this->musicSongs;
	}



	// =========================================
	// METHODS
	// =========================================

	public function load_musicSongs(Mysqli $mysqli) : bool
	{
		if ( empty($this->rowid) )
		{
			throw new Exception("ERREUR: la propriéé rowid est vide, donc impossible de charger les MusicSongs");
		}

		$rowid = $this->get_rowid();
	
		//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadManyRows($mysqli , 'music_song' , ["fk_album_rowid = $rowid"]);

		# echo '<pre>';  @var_dump($receivedRowDatas);  echo '</pre>';  exit('END');    // DEBUG

		foreach ($receivedRowDatas as $loopingRowDatas)
		{
			$musicsong = new MusicSong();
			$musicsong->fill_from_array($loopingRowDatas);

			$this->musicSongs[] = $musicsong;
		}
		
		return true;
	}



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
			$rowDatas['active'] = self::$setting_musicAlbumActiveByDefault; // WORKS
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->name)) // NOTE: here keep `empty` and not `!isset` cause an empty string is set, but we still don't want it !
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `name` n'est pas remplie.");
		} else {
			$rowDatas['name'] = $this->name;
		}

		if (isset($this->path_image))
			$rowDatas['path_image'] = $this->path_image; 

		if (isset($this->link_spotify))
			$rowDatas['link_spotify'] = $this->link_spotify; 

		if (isset($this->link_applemusic))
			$rowDatas['link_applemusic'] = $this->link_applemusic; 

		if (isset($this->link_itunes))
			$rowDatas['link_itunes'] = $this->link_itunes; 

		if (isset($this->link_deezer))
			$rowDatas['link_deezer'] = $this->link_deezer; 

		if (isset($this->link_amazonmusic))
			$rowDatas['link_amazonmusic'] = $this->link_amazonmusic; 

		if (isset($this->link_googleplay))
			$rowDatas['link_googleplay'] = $this->link_googleplay; 

		if (isset($this->link_tidal))
			$rowDatas['link_tidal'] = $this->link_tidal; 

		return $rowDatas;
	}
}


?>