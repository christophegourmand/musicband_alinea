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

	public function insertRow(Mysqli $mysqli , Model $object)
	{
		$rowDatas = $object->get_rowDatas();
		$arrayOfFields = array_keys($object->get_rowDatas());
		$arrayOfValues = array_values($object->get_rowDatas());
		
		//--- verifier que $object->rowDatas contient des données
		$nbrOfKeys = count( $arrayOfFields );
		if ($nbrOfKeys === 0)
		{
			throw new Exception ("ERREUR : Dans la classe DbHandler , la méthode insertRow() ne peut pas insérer de ligne en DB car la propriété rowDatas de l'objet semble vide (aucune clé)");
		}

		$sql_query = "INSERT INTO `".$object->get_tableName()."`";
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

		$mysqli_response = $mysqli->query($sql_query);

		if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		}

		return true; // REVIEW : bonne manière ?

	}


	//* FONCTIONNE
	/**
	* @param	Mysqli	$mysqli				instance of Mysqli
	* @param 	array	$whereConditions	Expected format example: ["id = 5" , "year=1998" , "firstname LIKE 'christ%'"]
	* @return	bool	Return true if success and false if not.
	*/
	public function loadRow (Mysqli $mysqli , Model $object , array $whereConditions = [])
	{
		$sql_query = "SELECT *";
		$sql_query .= " FROM `".$object->get_tableName()."`"; // don't mind the error, the method is accessible without any problem !


		//--- prepare whereConditions 
		if ( count($whereConditions) > 0 )
		{
			$sql_query .= " WHERE "; // important keep space after WHERE

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
		echo '<pre>';  @var_dump($mysqli_response->fetch_assoc());  echo '</pre>';  exit('reponse du SELECT');    //! DEBUG

		$object->set_rowDatas( $mysqli , $mysqli_response->fetch_assoc() );
		$mysqli_response->free();
	}


	/**
	* @param	Mysqli	$mysqli				instance of Mysqli
	* @param 	array	$whereConditions	Expected format example: ["id = 5" , "year=1998" , "firstname LIKE 'christ%'"]
	* @return	bool	Return true if success and false if not.
	*/
	public function updateRow (Mysqli $mysqli , Model $object , array $whereConditions = [])
	{
		// echo '<pre>';  @var_dump($object);  echo '</pre>';  //exit('END');    //! DEBUG

		$rowDatas = $object->get_rowDatas();
		echo '<script>console.info(`line_'.__LINE__.': $rowDatas`); console.debug('.json_encode($rowDatas).');</script>'; //! DEBUG
		$arrayOfFields = array_keys($object->get_rowDatas());
		$arrayOfValues = array_values($object->get_rowDatas());
		echo '<script>console.info(`line_'.__LINE__.': $arrayOfValues`); console.debug('.json_encode($arrayOfValues).');</script>'; //! DEBUG
		
		//--- verifier que $object->rowDatas contient des données
		$nbrOfKeys = count( $arrayOfFields );
		if ($nbrOfKeys === 0)
		{
			throw new Exception ("ERREUR : Dans la classe DbHandler , la méthode insertRow() ne peut pas insérer de ligne en DB car la propriété rowDatas de l'objet semble vide (aucune clé)");
		}

		//--- FORMAT ---
		/*
			UPDATE `tablename` SET `field1` = value1 , `field2` = value2 WHERE (condition1) AND (condition2);
		*/

		$sql_query = "UPDATE `".$object->get_tableName()."`";
		$sql_query .= " SET ";

		//--- avoir : `champs1` , `champs2` , `champs3`
		$arrayOfFieldsWithBacktilt = array_map( fn($value) => "`".$value."`"  ,  $arrayOfFields );
		echo '<script>console.info(`line_'.__LINE__.': $arrayOfFieldsWithBacktilt`); console.debug('.json_encode($arrayOfFieldsWithBacktilt).');</script>'; //! DEBUG

		//--- avoir : 'abc' , 'abc' , 1 , 'abc' , 0 , 'abc'
		$arrayOfValuesWithQuote = array_map(
			function($value) {
				//--- return the value sourrounded by quote if it's a string, and without if it's not a string
				return (gettype($value) === 'string') ? ("'".$value."'") : $value;
			}
			,
			$arrayOfValues 
		);
		echo '<script>console.info(`line_'.__LINE__.': $arrayOfValuesWithQuote`); console.debug('.json_encode($arrayOfValuesWithQuote).');</script>'; //! DEBUG

		//:o [1] VÉRIFIER SI JE VEUX UTILISER UN `FOR` ET LES ARRAYS CRÉÉS CI DESSUS OU UTILISER UN FOREACH
		for ($i = 0 ; $i < sizeof( $arrayOfFieldsWithBacktilt) ; $i++)
		{
			$sql_query .= $arrayOfFieldsWithBacktilt[$i]."=".$arrayOfValuesWithQuote[$i];
			
			#   size          5
			# 0  1  2  3  4
			if ($i < (sizeof( $arrayOfFieldsWithBacktilt)-1)  ) {
				$sql_query .= " , ";
			}
		}

		echo '<script>console.info(`line_'.__LINE__.': $sql_query`); console.debug('.json_encode($sql_query).');</script>'; //! DEBUG
		exit;


		//:o [2] ICI TOUS LES CHAMPS SERONT UPDATÉS , NE SERAIT-CE PAS MIEUX D'UPDATER SEULEMENT LES CHAMPS vOULUS ?


#		$mysqli_response = $mysqli->query($sql_query);
#
#		if (!$mysqli_response)
#		{
#			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
#		}
#
#		return true; // REVIEW : bonne manière ?

	}

} 
