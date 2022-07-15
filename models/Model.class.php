<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");

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
			$fieldsInfosFromDb = $this->fieldsInfosFromDb($mysqli);
		}
		catch (Exception $exception)
		{
			throw $exception;
		}

		$fieldsForForm = [];

		foreach ($fieldsInfosFromDb as $i => $arrayFieldsInfos) {
			// --- name of the field
			$fieldsForForm[$i]['fieldName'] = $arrayFieldsInfos['Field'];
			// --- type of the field
			$fieldsForForm[$i]['sql_type'] = $arrayFieldsInfos['Type'];
			$fieldsForForm[$i]['form_input_type'] = self::convertSqlTypeToFormInputType($fieldsForForm[$i]['sql_type']);
			$fieldsForForm[$i]['id'] = $this->get_tablename().'_'.$fieldsForForm[$i]['fieldName'];
			$fieldsForForm[$i]['name'] = $this->get_tablename().'_'.$fieldsForForm[$i]['fieldName']; // attribute of html input of form

			// --- attribute `required` if field can't be null in database table
			$fieldsForForm[$i]['attribute_required'] = ($arrayFieldsInfos['Null'] === 'NO') ? 'required' : '';
			$fieldsForForm[$i]['getter_method_name'] = 'get_'.$fieldsForForm[$i]['fieldName']/* .'()' */;
		}

		return $fieldsForForm;
	}




}

?>