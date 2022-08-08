<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

class Model {

	/**
	* @var string	must contain table's name in database (including prefix)
	*/
	protected string $tableName;

	/**
	* @var	int		once the object has been filled from database, $this->rowid must contain the rowid.
	*/ 
	protected int $rowid;

	protected static $dbHandler;

	public function __construct(string $given_tableName)
	{
		$this->tableName = $given_tableName;
		self::$dbHandler = new DbHandler();
	}

	//--- pas besoin de setter
	public function get_tableName() :string
	{
		if ( isset($this->tableName) && !empty($this->tableName) )
		{
			return $this->tableName;
		} else {
			return "";
		}
	}


	// TODO : A TESTER
	public function set_rowid(int $given_rowid) :void
	{
		$this->rowid = $given_rowid;
	}

	// FONCTIONNE
	public function get_rowid() :int
	{
		return $this->rowid;
	}


	// FONCTIONNE
	/**
	* @param 	array 	$rowDatas 	Must be formatted as ['rowid'=>5, 'name'=> 'toto' , etc] according to class of object  
	*/
	public function fill_from_array(array $rowDatas) : bool
	{
		foreach ($rowDatas as $fieldname => $value)
		{
			if ($value == null)
				$value = '';
				
			// var_dump($fieldname);
			// var_dump($value);
			// var_dump($this->{$fieldname}); //NOTE fonctionne mais ne peut pas accéder car la propriété est sur 'private'

			if (property_exists($this , $fieldname)) 
			{
				/*--- methode pour utiliser chaque méthode `set_xxx()` selon le $fieldname 
				(à utiliser si les propriétés sont sur `private` ) */
				
				# $methodName = 'set_'.$fieldname;
				# $this->$methodName($value);

				/*--- methode pour affecter directement avec $this->nomDuChamps selon le $fieldname 
				(à utiliser si les propriétés sont sur `protected`) */

				$this->{$fieldname} = $value;
			}
		}

		return true;
	}


	public function fieldsInfosFromDb(Mysqli $mysqli)
	{
		try
		{
			// $fieldsNamesFromDb = self::$dbHandler->getFieldsNames($mysqli, $this->get_tableName());
			$fieldsInfosFromDb = self::$dbHandler->getFieldsInfos($mysqli, $this->get_tableName());
		}
		catch (Exception $exception)
		{
			throw $exception;
		}

		// return $fieldsNamesFromDb;
		return $fieldsInfosFromDb;
	}

	/**
	* @param 	string 	$sqlType 	The type of the field (=column) in the sql table
	* @return 	string 			The type of html tag input (<input='xxxxx'> , or 'textarea', ...)
	*/
	static function convertSqlTypeToFormInputType (string $sqlType):string
	{
		
		//--- varchar >>> input type='text'
		if ( strstr($sqlType , 'varchar') ) 
		{
			$formInputType = 'text';
		}
		//--- tinyint >>> input type='text'
		elseif ( strstr($sqlType , 'tinyint') ) //--- keep the search of `tinyint` before `int`.
		{
			$formInputType = 'text';
		}
		//--- int >>> input type='text'
		elseif ( strstr($sqlType , 'int') )
		{
			$formInputType = 'text';
		}
		//--- mediumtext >>> textarea
		elseif ( strstr($sqlType , 'mediumtext') )
		{
			$formInputType = 'textarea';
		}
		
		//--- date >>> input type='date'  // À VÉRIFIER
		elseif ( strstr($sqlType , 'date') )
		{
			$formInputType = 'date';
		}

		//--- time >>> input type='time'  // À VÉRIFIER
		elseif ( strstr($sqlType , 'time') )
		{
			$formInputType = 'time'; // LINK : https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/time
		}
		else
		{
			$formInputType = 'undetected by Model::convertSqlTypeToFormInputType()';
		}
		

		// TEST ------------------------
		/* if ( strstr($sqlType , 'int') )
		{
			$formInputType = 'text';
		} else
		{
			$formInputType = 'undetected by Model::convertSqlTypeToFormInputType()';
		} */

		return $formInputType;
	}
	
	public function fieldsInfosForForm(Mysqli $mysqli)
	{
		try
		{
			/**
			* @example 
			* array (size=7)
			*	0 => 
			*		array (size=6)
			*		'Field' => string 'rowid' (length=5)
			*		'Type' => string 'int(4)' (length=6)
			*		'Null' => string 'NO' (length=2)
			*		'Key' => string 'PRI' (length=3)
			*		'Default' => null
			*		'Extra' => string 'auto_increment' (length=14)
			*	1 => ......
			*/
			$fieldsInfosFromDb = $this->fieldsInfosFromDb($mysqli);
		}
		catch (Exception $exception)
		{
			throw $exception;
		}

		$fieldsForForm = [];

		foreach ($fieldsInfosFromDb as $i => $arrayFieldsInfos) 
		{
			# var_dump($arrayFieldsInfos); // DEBUG

			// TODO : prendre le champs qui boucle `$arrayFieldsInfos['Field']` et trouver le bon sous-array dans `$fieldsToPrintInForm`
			
			foreach ( static::$fieldsToPrintInForm as $childClass_fieldToPrintInForm) {
				// --- if the looping fields from the table in Database correspond to the looping field inside `$fieldsToPrintInForm` from child class 
				if ($childClass_fieldToPrintInForm['fieldnameInSql'] === $arrayFieldsInfos['Field'])
				{
					if ( $childClass_fieldToPrintInForm['canBeDisplayed'] )
					{
						// --- name of the field
						$fieldsForForm[$i]['fieldName'] = $arrayFieldsInfos['Field'];
						// --- type of the field
						$fieldsForForm[$i]['sql_type'] = $arrayFieldsInfos['Type'];
						$fieldsForForm[$i]['form_input_type'] = self::convertSqlTypeToFormInputType($fieldsForForm[$i]['sql_type']);
						$fieldsForForm[$i]['idAttribute'] = $this->get_tablename().'_'.$fieldsForForm[$i]['fieldName'];
						$fieldsForForm[$i]['nameAttribute'] = $fieldsForForm[$i]['fieldName']; // attribute of html input of form

						// --- attribute `required` if field can't be null in database table
						$fieldsForForm[$i]['attribute_required'] = ($arrayFieldsInfos['Null'] === 'NO') ? 'required' : '';
						// --- attribute `readonly` if the user should not modify it.
						$fieldsForForm[$i]['attribute_readonly'] = ($childClass_fieldToPrintInForm['canBeSet']) ? '' : 'readonly'; // NOTE : possible to use `readonly` instead of `disabled`
						
						$fieldsForForm[$i]['getter_method_name'] = 'get_'.$fieldsForForm[$i]['fieldName']/* .'()' */;

						/* TODO check if this array is really the best solution
							advantages of this array : 
								- it automatically provide informations such as field-name, field-type , attribute required if can't be null in database , etc..
							disadvantages :
								- it doesn't precise if each field should be displayed or not
								- it doesn't precise if each field should be modifyable of not
						*/
					}
				}
			}

		}

		return $fieldsForForm;
	}

	/**
	* each child class of Model possess a property array
	* called `$fieldsInfos`. This function will add some keys and values
	* necessary to create the html-form, or to create the controller 
	* who deal with the form.
	*
	* @param    Mysqli    $mysqli    instance of Mysqli
	* @return   void
	*/
	public function completeFieldsInDbInfos(Mysqli $mysqli)
	{
		try
		{
			/**
			* @example 
			* array (size=7)
			*	0 => 
			*		array (size=6)
			*		'Field' => string 'rowid' (length=5)
			*		'Type' => string 'int(4)' (length=6)
			*		'Null' => string 'NO' (length=2)
			*		'Key' => string 'PRI' (length=3)
			*		'Default' => null
			*		'Extra' => string 'auto_increment' (length=14)
			*	1 => ......
			*/
			$fieldsInfosFromDb = $this->fieldsInfosFromDb($mysqli);
		}
		catch (Exception $exception)
		{
			throw $exception;
		}

		/*                       old name :  $arrayFieldsInfos */
		foreach ($fieldsInfosFromDb as $i => $fieldInfosFromDb)
		{
			//--- shortcut for fieldname
			$fieldNameFromDb = $fieldInfosFromDb['Field'];
			
			//--- shortcut for subarray of array $fieldsInfos in each child class
			$arrayOfFieldInfosInEntityClass = &static::$fieldsInfos[$fieldNameFromDb];

			//--- attribute `id=""`
			# $arrayOfFieldInfosInEntityClass['idAttribute'] = $this->get_tablename().'_'.$fieldNameFromDb;
			
			$arrayOfFieldInfosInEntityClass['idAttribute'] = static::TABLENAME.'_'.$fieldNameFromDb;
			
			//--- attribute `name=""`
			$arrayOfFieldInfosInEntityClass['nameAttribute'] = $fieldNameFromDb;

			//--- attribute `required`
			$arrayOfFieldInfosInEntityClass['attribute_required'] = ($fieldInfosFromDb['Null'] === 'NO') ? 'required' : '';

			//--- attribute `readonly`
			$arrayOfFieldInfosInEntityClass['attribute_readonly'] = ($arrayOfFieldInfosInEntityClass['canBeSet']) ? '' : 'readonly';
		}

	}

	/**
	* this function look in the child class for a static array `$fieldsInfos` , look at the key
	* corresponding to $fieldname , and then the key 'regex' , and check if the value  had bad characters.
	* @param 	string 	$fieldName 	: the name of the field (so of the key) to look into $fieldsInfos.
	* @param 	string	$given_value : the value passed as param of set_xxxxxxxx()
	* @return 	string|false 	: array if contain bad characters, false if doesn't , null if error.
	*/
	public static function fieldContainBadCharacters(string $fieldName , string $given_value)
	{
		//--- if no regex defined for that field, we consider that it doesn't contain bad characters.
		if (!isset(static::$fieldsInfos[$fieldName]['regex']))
		{
			return false;
		}

		if (static::$fieldsInfos[$fieldName]['regex'] === null)
		{
			return false;
		}

		$badCharacters_arr = [];
		$containBadCharactersResult = preg_match(static::$fieldsInfos[$fieldName]['regex'], $given_value, $badCharacters_arr); //--- 1 if match , 0 if no match , false if error

		if ($containBadCharactersResult === false) // error from preg_match
		{
			$errorMessage = "la fonction preg_match() en recherche de mauvais caractères pour le champs ${fieldName} a fait l'objet d'une erreur.";
			
			throw new Exception($errorMessage);

			/* NOTE other possibility :
			redirectOnPageMessageWithCustomMessage($errorMessage,"error");
			*/
		}

		if ($containBadCharactersResult === 1) // some bad characters
		{
			$badCharacters_str = "caractères interdits détectés dans le champs ${fieldName} : ";
			$badCharacters_str .= implode('', $badCharacters_arr);
			return $badCharacters_str;
			
		} else if ($containBadCharactersResult === 0) // no bad characters
		{
			return false;
		}

	}


}

?>