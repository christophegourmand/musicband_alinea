<?php

use FFI\Exception;

require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/Modelable.interface.php");

require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class Concert extends Model implements Modelable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected int $active = 0;
	protected string $date = '';
	protected string $hour_start = '';
	protected string $hour_end = '';
	protected string $venue_name = '';
	protected string $city_name = '';
	protected string $url_map = '';
	protected string $path_image = '';
	protected string $description = '';

	protected DateTime $datetime; // initialized in constructor
	protected int $timestamp = 0;
	private static int $setting_concertActiveByDefault = 1; //--- set 0 for inactive , 1 for active

	//--- not in database, attached to the class :
	const TABLENAME = 'concert';
	public static string $iconHtml = '<i class="far fa-calendar-alt"></i>';
	public static string $entityNameSingular = 'Concert';
	public static string $entityNamePlural = 'Concerts';
	public static string $explanation = 'Concerts : contient les dates, lieux, villes, map, et image';
	public static array $fieldsToPrintInDashboard = [
		['fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id']
		, ['fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif']
		, ['fieldnameInSql' => 'date' , 'fieldnameInHtml' => 'date']
		, ['fieldnameInSql' => 'venue_name' , 'fieldnameInHtml' => 'nom de la salle']
		# , ['fieldnameInSql' => 'city_name' , 'fieldnameInHtml' => 'ville']
	];
	
	/**
	* 
	* @depreacted : You should soon use `$fieldsInfos` instead
	*/
	public static array $fieldsToPrintInForm = [
		[ 'fieldnameInSql' => 'rowid' , 'fieldnameInHtml' => 'id' , 'canBeDisplayed' => true , 'canBeSet' => false ],
		[ 'fieldnameInSql' => 'active' , 'fieldnameInHtml' => 'actif' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'date' , 'fieldnameInHtml' => 'date' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'hour_start' , 'fieldnameInHtml' => 'heure début' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'hour_end' , 'fieldnameInHtml' => 'heure de fin' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'venue_name' , 'fieldnameInHtml' => 'nom de la salle' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'city_name' , 'fieldnameInHtml' => 'ville' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'url_map' , 'fieldnameInHtml' => 'lien vers carte' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'path_image' , 'fieldnameInHtml' => 'chemin vers image' , 'canBeDisplayed' => true , 'canBeSet' => true ],
		[ 'fieldnameInSql' => 'description' , 'fieldnameInHtml' => 'description' , 'canBeDisplayed' => true , 'canBeSet' => true ]
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
		'date' => [
			'fieldnameInSql' => 'date' 
			, 'fieldnameInHtml' => 'date' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'date'
			, 'phpType' => 'string'
			, 'regex' => "/[^0-9\-\:\,\.]/iu"
			, 'max_length' => null
		],
		'hour_start' => [
			'fieldnameInSql' => 'hour_start' 
			, 'fieldnameInHtml' => 'heure de début' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'time'
			, 'phpType' => 'string'
			, 'regex' => "/[^0-9\-\:\,\.]/iu"
			, 'max_length' => null
		],
		'hour_end' => [
			'fieldnameInSql' => 'hour_end' 
			, 'fieldnameInHtml' => 'heure de fin' 
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'time'
			, 'phpType' => 'string'
			, 'regex' => "/[^0-9\-\:\,\.]/iu"
			, 'max_length' => null
		],
		'venue_name' => [
			'fieldnameInSql' => 'venue_name'
			, 'fieldnameInHtml' => 'nom de la salle'
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\s\d\-]/iu"
			, 'max_length' => 100
		],
		'city_name' => [
			'fieldnameInSql' => 'city_name'
			, 'fieldnameInHtml' => 'ville'
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => "/[^\w\s\-]/iu"
			, 'max_length' => 100
		],
		'url_map' => [
			'fieldnameInSql' => 'url_map' 
			, 'fieldnameInHtml' => 'lien vers carte'
			, 'canBeDisplayed' => true
			, 'canBeSet' => true
			, 'htmlInputType' => 'text'
			, 'phpType' => 'string'
			, 'regex' => null
			, 'max_length' => null
			, 'max_length' => 512
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
			, 'regex' => "/[^\w\s\d\'\_\-\"\,\.\!\?\:\;\&\(\)\€\r\n\/]/iu"
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
		parent::__construct('concert');
		parent::completeFieldsInDbInfos($mysqli);

		$this->datetime = new DateTime();
		
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
		$this->city_name = (string) $receivedRowDatas['city_name'];
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
	public function set_active(int $value_given){
		//--- on met la valeur à 0 si celle passée est négative , et on met à 1 si supérieur à 0 (donc 1 et au delà)
		if ($value_given <= 0)
		{
			$value_given = 0;
		} else {
			$value_given = 1;
		}

		$this->active = $value_given; 
	}


	public function set_date(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($value_given) > 10)
		{
			throw new Exception("ERREUR : le date donné est supérieur à 10 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('date', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->date = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}

	public function set_hour_start(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($value_given) > 10)
		{
			throw new Exception("ERREUR : le hour_start donné est supérieur à 10 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('hour_start', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->hour_start = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}
	
	public function set_hour_end(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($value_given) > 10)
		{
			throw new Exception("ERREUR : le hour_end donné est supérieur à 10 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('hour_end', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->hour_end = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}	
	}


	public function set_venue_name(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($value_given) > 50)
		{
			throw new Exception("ERREUR : le venue_name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}

		$badCharactersResult = parent::fieldContainBadCharacters('venue_name', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->venue_name = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}

	public function set_city_name(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`

		// renvoyer erreur si taille > 50
		if (strlen($value_given) > 50)
		{
			throw new Exception("ERREUR : le city_name donné est supérieur à 50 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('city_name', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->city_name = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}
	
	public function set_url_map(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$fieldname = 'url_map';

		// renvoyer erreur si taille > 512
		if (strlen($value_given) > 512)
		{
			throw new Exception("ERREUR : le url_map donné est supérieur à 512 caractères, ce qui est la limite.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('url_map', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			//--- REVIEW : vérifier si je dois effectivement nettoyer le lien qui est donné dans le formulaire.
				// --- si oui :
			// $this->url_map = mysqli_real_escape_string($mysqli , $value_given);
				// --- si non :
				$this->url_map = $value_given;
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
			// $this->path_image = mysqli_real_escape_string($mysqli , $value_given);
				// --- si non :
				$this->path_image = $value_given;
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
	}

	public function set_description(string $value_given) : bool
	{
		global $mysqli; // NOTE: utilisé pour fonction `mysqli_real_escape_string()`
		$fieldname = 'description';

		//--- renvoyer erreur si taille > 16000000 (normally 16777215 max for a MEDIUMTEXT)
		//LINK - https://www.mysqltutorial.org/mysql-text/

		if (strlen($value_given) > 16000000)
		{
			throw new Exception("ERREUR : le description donné est supérieur à 16000000 caractères, la limite étant 16777215 pour un MEDIUMTEXT.");
			;
		}
		
		$badCharactersResult = parent::fieldContainBadCharacters('description', $value_given); //--- return string or false
		if (is_string($badCharactersResult))
		{
			redirectOnPageMessageWithCustomMessage($badCharactersResult,"error");
		} else if ($badCharactersResult === false)
		{
			$this->description = mysqli_real_escape_string($mysqli , $value_given);
			return true;
		} else
		{
			//--- if the code didn't go in `return true`, we return false as it means we had a problem
			return false; 
		}
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
		if (isset($this->rowid))
			$rowDatas['rowid'] = $this->rowid; 


		//--- si vide , on prend une valeur par defaut , si non vide , on le prend
		if (! isset($this->active))
		{
			$rowDatas['active'] = self::$setting_concertActiveByDefault; // WORKS
		} else {
			$rowDatas['active'] = (int) $this->active; // converted as int , (but should already be the case) 
		}

		//--- si non vide, on le prend	
		if (isset($this->date))
		{
			$rowDatas['date'] = $this->date;
		}

		//--- si non vide, on le prend	
		if (isset($this->hour_start))
		{
			$rowDatas['hour_start'] = $this->hour_start;
		}

		//--- si non vide, on le prend	
		if (isset($this->hour_end))
		{
			$rowDatas['hour_end'] = $this->hour_end;
		}


		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (!isset($this->venue_name))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `venue_name` n'est pas remplie.");
		} else {
			$rowDatas['venue_name'] = $this->venue_name;
		}

		//--- si non vide, on le prend	
		if (isset($this->city_name))
		{
			$rowDatas['city_name'] = $this->city_name;
		}


		//--- si non vide, on le prend	
		if (isset($this->url_map))
		{
			$rowDatas['url_map'] = $this->url_map;
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

		return $rowDatas;
	}

}


?>