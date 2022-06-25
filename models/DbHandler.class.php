<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/Modelable.interface.php");

class DbHandler 
{

	// =========================================
	// PROPERTIES
	// =========================================

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		return true;
	}

	// =========================================
	// GETTERS-SETTERS
	// =========================================


	// =========================================
	// METHODS
	// =========================================

		
	/**
	 * insertRow
	 *
	 * @param 	Mysqli 		$mysqli			instance of Mysqli
	 * @param 	string 		$tablename		ex: 'user' or 'concert'
	 * @param 	mixed 		$rowDatas 		
	 * @return	bool
	 */
	public function insertRow(Mysqli $mysqli , string $tablename, array $rowDatas) : bool
	{
		
		$arrayOfFields = array_keys($rowDatas);
		$arrayOfValues = array_values($rowDatas);
		
		//--- verifier que $object->rowDatas contient des données
		$nbrOfKeys = count( $arrayOfFields );
		if ($nbrOfKeys === 0)
		{
			throw new Exception ("ERREUR : Dans la classe DbHandler , la méthode insertRow() ne peut pas insérer de ligne en DB car la propriété rowDatas de l'objet semble vide (aucune clé)");
		}

		$sql_query = "INSERT INTO `".$tablename."`";
		$sql_query .= " (";

		//--- avoir : `champs1` , `champs2` , `champs3`
		$arrayOfFieldsWithBacktilt = array_map( fn($value) => "`".$value."`"  ,  $arrayOfFields );
		$stringOfFiedlsSeparatedByComma = implode(' , ' , $arrayOfFieldsWithBacktilt);
		$sql_query .= $stringOfFiedlsSeparatedByComma;

		$sql_query .= ")";
		$sql_query .= " VALUES (";

		//--- avoir : 'abc' , 'abc' , 1 , 'abc' , 0 , 'abc'
		$arrayOfValuesWithQuote = array_map( 
			function($value) {
				//--- return the value sourrounded by quote if it's a string, and without if it's not a string
				return (gettype($value) === 'string') ? ("'".$value."'") : $value ;
			}
			,
			$arrayOfValues 
		);
		$sql_query .= implode(' , ' , $arrayOfValuesWithQuote );
		$sql_query .= " )";

		// echo '<script>console.info(`line_'.__LINE__.': $sql_query`); console.debug('.json_encode($sql_query).');</script>'; exit(); // DEBUG

		$mysqli_response = $mysqli->query($sql_query);

		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}

		return true; // REVIEW : bonne manière ?
	}


	
	/**
	* @param	Mysqli	$mysqli				instance of Mysqli
	* @param 	string	$tablename			ex: 'user' or 'concert'
	* @param 	array	$whereConditions	Expected format example: ["id = 5" , "year=1998" , "firstname LIKE 'christ%'"]
	* @return	bool	Return true if success and false if not.
	*/
	public function loadRow(Mysqli $mysqli , string $tablename, array $whereConditions = []) : array
	{
		$sql_query = "SELECT *";
		$sql_query .= " FROM `".$tablename."`";


		//--- prepare whereConditions 
		if ( count($whereConditions) > 0 )
		{
			$sql_query .= " WHERE "; // important: keep space after WHERE

			$whereConditionsWithParentheses = array_map( fn($value) => "($value)" , $whereConditions);
			$whereConditionsAsString = implode(' AND ' , $whereConditionsWithParentheses);
			$sql_query .= $whereConditionsAsString;
		}
		
		//--- in any case , we limit at 1 row only
		$sql_query .= " LIMIT 1";

		$mysqli_response = $mysqli->query($sql_query);

		//--- $mysqli_response will be empty if $sql_query was wrong , and will be filled with stats if success.

		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}
		if ($mysqli_response && $mysqli_response->num_rows > 1)
		{
			throw new Exception("Mysqli a retourné plus d'1 row pour cette requête :\n" . $sql_query);
		}
		
		$rowDatas = $mysqli_response->fetch_assoc();

		$mysqli_response->free();

		return $rowDatas;
	}

	/**
	* @param	Mysqli	$mysqli				instance of Mysqli
	* @param 	string	$tablename			ex: 'user' or 'concert'
	* @param 	array	$whereConditions	Expected format example: ["id = 5" , "year=1998" , "firstname LIKE 'christ%'"]
	* @return	array	Return indexed array containing rowDatas of Users or Concerts, etc.
	*/
	public function loadManyRows(Mysqli $mysqli , string $tablename, array $whereConditions = []) : array
	{
		$sql_query = "SELECT *";
		$sql_query .= " FROM `".$tablename."`";


		//--- prepare whereConditions 
		if ( count($whereConditions) > 0 )
		{
			$sql_query .= " WHERE "; // important: keep space after WHERE

			$whereConditionsWithParentheses = array_map( fn($value) => "($value)" , $whereConditions);
			$whereConditionsAsString = implode(' AND ' , $whereConditionsWithParentheses);
			$sql_query .= $whereConditionsAsString;
		}
		
		//--- in any case , we limit at 1 row only
		# $sql_query .= " LIMIT 1";

		$mysqli_response = $mysqli->query($sql_query);

		//--- $mysqli_response will be empty if $sql_query was wrong , and will be filled with stats if success.

		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}
		
		$retreivedRows = [];
		$nbrOfRows = $mysqli_response->num_rows;
		$i = 1;
		while ($i <= $nbrOfRows)
		{
			$rowDatas = $mysqli_response->fetch_assoc(); // REVIEW : it waas possible to use fetch_all() , then no-need a loop`while`.
			$retreivedRows[] = $rowDatas;
			$i++;
		}

		$mysqli_response->free();

		return $retreivedRows;
	}



	/**
	* @param	Mysqli	$mysqli		instance of Mysqli
	* @param 	string	$tablename	ex: 'user' or 'concert'
	* @param 	array	$rowDatas	
	* @param 	int		$rowid		rowid of the database row to update
	* @return	bool	Return true if success and false if not.
	*/
	public function updateRow(Mysqli $mysqli , string $tablename , array $rowDatas , int $rowid)
	{
		$arrayOfFields = array_keys($rowDatas);
		$arrayOfValues = array_values($rowDatas);
		
		//--- verifier que $rowDatas contient des données
		$nbrOfKeys = count( $arrayOfFields );
		if ($nbrOfKeys === 0)
		{
			throw new Exception ("ERREUR : Dans la classe DbHandler , la méthode insertRow() ne peut pas insérer de ligne en DB car la propriété rowDatas de l'objet semble vide (aucune clé)");
		}

		if (!in_array('rowid', $arrayOfFields ))
		{
			throw new Exception("impossible d'updater la row, si la clé rowid n'est pas remplie dans l'array rowDatas passé en paramètre de updateRow()");
		}

		//--- FORMAT DE LA REQUETE ---
		/*
			UPDATE `tablename` SET `field1` = value1 , `field2` = value2 WHERE (condition1) AND (condition2);
		*/

		$sql_query = "UPDATE `".$tablename."`";
		$sql_query .= " SET ";

		//--- on veut avoir : `champs1` , `champs2` , `champs3`
		$arrayOfFieldsWithBacktilt = array_map( fn($value) => "`".$value."`"  ,  $arrayOfFields );

		//--- on veut avoir : 'abc' , 'abc' , 1 , 'abc' , 0 , 'abc'
		$arrayOfValuesWithQuote = array_map(
			function($value) {
				//--- return the value sourrounded by quote if it's a string, and without if it's not a string
				return (gettype($value) === 'string') ? ("'".$value."'") : $value;
			}
			,
			$arrayOfValues 
		);

		for ($i = 0 ; $i < sizeof( $arrayOfFieldsWithBacktilt) ; $i++)
		{
			$sql_query .= $arrayOfFieldsWithBacktilt[$i]."=".$arrayOfValuesWithQuote[$i];
			
			if ($i < (sizeof( $arrayOfFieldsWithBacktilt)-1)  ) {
				$sql_query .= " , ";
			}
		}
		$sql_query .= " WHERE rowid=".$rowid;

		//:o [2] ICI TOUS LES CHAMPS SERONT UPDATÉS , NE SERAIT-CE PAS MIEUX D'UPDATER SEULEMENT LES CHAMPS vOULUS ?
		$mysqli_response = $mysqli->query($sql_query);

		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}

		return true; // REVIEW : bonne manière ?

	}

	/**
	* @param	Mysqli	$mysqli		instance of Mysqli
	* @param 	string	$tablename	ex: 'user' or 'concert'
	* @param 	int		$rowid		rowid of the database row to update
	* @return	bool	Return true if success and false if not.
	*/
	public function deleteRow(Mysqli $mysqli , string $tablename, int $rowid) : bool
	{
		$sql_query = "DELETE FROM `".$tablename."`";
		$sql_query .= " WHERE rowid=".$rowid;
		$mysqli_response = $mysqli->query($sql_query);
		
		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}

		return true;
	}

	/**
	* @param	Mysqli	$mysqli		instance of Mysqli
	* @param 	string	$tablename	ex: 'user' or 'concert'
	* @return	array	Return array ['field1','field2','field3','field4'].
	*/
	public function getFields(Mysqli $mysqli , string $tablename) : array
	{
		$sql_query = "SHOW COLUMNS FROM `".$tablename."`";
		$mysqli_response = $mysqli->query($sql_query);
		
		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}

		$indexedArrayOfFieldsInfos = $mysqli_response->fetch_all(MYSQLI_ASSOC);

		$fieldsArray = [];
		for ($i=0 ; $i < count($indexedArrayOfFieldsInfos) ; $i++)
		{
			array_push($fieldsArray , $indexedArrayOfFieldsInfos[$i]['Field']);
		}

		$mysqli_response->free();

		return $fieldsArray;
	}





} 
