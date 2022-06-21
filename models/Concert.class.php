<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class Concert extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected int $active;
	protected string $date;
	protected string $hour_start;
	protected string $hour_end;
	protected string $venue_name;
	protected string $city_name;
	protected string $url_map;
	protected string $path_image;
	protected string $description;

	//--- set 0 for inactive , 1 for active
	protected DateTime $datetime;
	protected int $timestamp;
	private static int $setting_concertActiveByDefault = 1;

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('concert');

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
		$this->date = (string) $receivedRowDatas['date'];
		$this->hour_start = (string) $receivedRowDatas['hour_start'];
		$this->hour_end = (string) $receivedRowDatas['hour_end'];
		$this->venue_name = (string) $receivedRowDatas['venue_name'];
		$this->url_map = (string) $receivedRowDatas['url_map'];
		$this->path_image = (string) $receivedRowDatas['path_image'];
		$this->description = (string) $receivedRowDatas['description'];
		
		return true;
	}
	
	public function update(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible d'updater un concert si la propriété `rowid` n'est pas remplie.");
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
			throw new Exception("ERREUR: impossible de supprimer un concert si la propriété `rowid` n'est pas remplie.");
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


	public function set_date(string $date_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($date_given) > 10)
		{
			throw new Exception("ERREUR : le date donné est supérieur à 10 caractères, ce qui est la limite.");
			;
		}
		
		$containBadCharacters = preg_match("/[^0-9\-\:\,\.]/iu", $date_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le date donné contient des caractères autres que letters");
			;
		}
	
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->date = mysqli_real_escape_string($mysqli , $date_given);
		
		return true;
	}

	public function set_hour_start(string $hour_start_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($hour_start_given) > 10)
		{
			throw new Exception("ERREUR : le hour_start donné est supérieur à 10 caractères, ce qui est la limite.");
			;
		}
		
		$containBadCharacters = preg_match("/[^0-9\-\:\,\.]/iu", $hour_start_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le hour_start donné contient des caractères autres que letters");
			;
		}
	
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->hour_start = mysqli_real_escape_string($mysqli , $hour_start_given);
		
		return true;
	}
	
	public function set_hour_end(string $hour_end_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($hour_end_given) > 10)
		{
			throw new Exception("ERREUR : le hour_end donné est supérieur à 10 caractères, ce qui est la limite.");
			;
		}
		
		$containBadCharacters = preg_match("/[^0-9\-\:\,\.]/iu", $hour_end_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le hour_end donné contient des caractères autres que letters");
			;
		}
	
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->hour_end = mysqli_real_escape_string($mysqli , $hour_end_given);
		
		return true;
	}


	public function set_venue_name(string $venue_name_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($venue_name_given) > 50)
		{
			throw new Exception("ERREUR : le venue_name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		// renvoi erreur si comporte des caractères non-autorisés
		$containBadCharacters = preg_match("/[^\w \-]/iu", $venue_name_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le venue_name donné contient des caractères autres que letters");
			;
		}

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->venue_name = mysqli_real_escape_string($mysqli , $venue_name_given);
		
		return true;
	}

	public function set_city_name(string $city_name_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($city_name_given) > 50)
		{
			throw new Exception("ERREUR : le city_name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		// renvoi erreur si comporte des caractères non-autorisés
		$containBadCharacters = preg_match("/[^\w \-]/iu", $city_name_given) ? true : false;

		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le city_name donné contient des caractères autres que letters");
			;
		}

		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		$this->city_name = mysqli_real_escape_string($mysqli , $city_name_given);
		
		return true;
	}
	
	public function set_url_map(string $url_map_given) : bool
	{
		 global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 512
		if (strlen($url_map_given) > 512)
		{
			throw new Exception("ERREUR : le url_map donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		// TODO : faire les verifications (taille, caracteres, etc, au niveau javascript, pas ici)
		
		//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
			// --- si oui :
		// $this->url_map = mysqli_real_escape_string($mysqli , $url_map_given);
			// --- si non :
			$this->url_map = $url_map_given;
		
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

	public function set_datetime_auto() : bool
	{
		if (!empty($this->date) && !empty($this->hour_start))
		{
			$this->datetime = DateTime::createFromFormat(
				"Y-m-d H:i:s", 
				$this->date.' '.$this->hour_start, 
				new DateTimeZone('Europe/Paris')
				// LINK : https://www.php.net/manual/en/class.datetimezone.php
				// LINK : https://www.php.net/manual/en/datetimezone.construct.php
				// LINK : https://www.php.net/manual/en/timezones.php
				// LINK : https://www.php.net/manual/en/timezones.europe.php
			);

			# echo '<pre>';  @var_dump($this->datetime);  echo '</pre>';  exit();    //! DEBUG

			return true;
		} else if (!empty($this->date) && empty($this->hour_start)) // if we have a date but no hour_start
		{
			$this->datetime = DateTime::createFromFormat(
				"Y-m-d", 
				$this->date,
				new DateTimeZone('Europe/Paris')
				// LINK : https://www.php.net/manual/en/class.datetimezone.php
				// LINK : https://www.php.net/manual/en/datetimezone.construct.php
				// LINK : https://www.php.net/manual/en/timezones.php
				// LINK : https://www.php.net/manual/en/timezones.europe.php
			);
			
			return true;
		}
		else 
		{
			return false;
		}
	}


	//--- Getters ----------------------------------

	public function get_active() : int
	{ 
		return $this->active;
	}

	public function get_date() : string 
	{ 
		return $this->date; 
	}

	public function get_hour_start() : string 
	{ 
		return $this->hour_start; 
	}

	public function get_hour_end() : string 
	{ 
		return $this->hour_end; 
	}

	public function get_venue_name() : string 
	{ 
		return $this->venue_name; 
	}

	public function get_city_name() : string 
	{ 
		return $this->city_name; 
	}

	public function get_url_map() : string 
	{ 
		return $this->url_map; 
	}

	public function get_path_image() : string 
	{ 
		return $this->path_image; 
	}

	public function get_description() : string 
	{ 
		return $this->description; 
	}

	public function get_datetime() : DateTime
	{
		$this->set_datetime_auto();
		
		return $this->datetime;
	}


	// =========================================
	// METHODS
	// =========================================

	public function get_date_french_string()
	{
		if (!empty($this->date))
		{
			$set_datetime_auto_success = $this->set_datetime_auto();
			if (! $set_datetime_auto_success)
			{
				return "(Oups, date à corriger)";
			} else 
			{
				//--- si hour_start est définie , on renvoi un string avec l'heure
				if (!empty($this->hour_start))
				{
					$date_english_str = $this->datetime->format("l j F Y"." - "."H"."\h"."i"); // monday 5 March 2022 à 20h00
					$date_french_str = translateDaysAndMonths($date_english_str);
					return $date_french_str;
				}
				//--- si hour_start n'est pas définie , on renvoi un string avec la date seulement
				else
				{
					$date_english_str = $this->datetime->format("l j F Y"); // monday 5 March 2022
					$date_french_str = translateDaysAndMonths($date_english_str);
					return $date_french_str;
				}
			}
		} else {
			return "(Pas encore de date)";
		}
	}



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
			$rowDatas['active'] = self::$setting_concertActiveByDefault; // WORKS
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si non vide, on le prend	
		if (!empty($this->date))
		{
			$rowDatas['date'] = $this->date;
		}

		//--- si non vide, on le prend	
		if (!empty($this->hour_start))
		{
			$rowDatas['hour_start'] = $this->hour_start;
		}

		//--- si non vide, on le prend	
		if (!empty($this->hour_end))
		{
			$rowDatas['hour_end'] = $this->hour_end;
		}


		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->venue_name))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `venue_name` n'est pas remplie.");
		} else {
			$rowDatas['venue_name'] = $this->venue_name;
		}

		//--- si non vide, on le prend	
		if (!empty($this->url_map))
		{
			$rowDatas['url_map'] = $this->url_map;
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

		return $rowDatas;
	}


}


?>