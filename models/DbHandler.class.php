<?php

class DbHandler {

	// =========================================
	// PROPERTIES
	// =========================================
	
	/**
	* @var string	must contain the prefix of table's name in database
	* (! i choose static because every child class will have only one tableName (attached to the class, not the instance).
	* please access it using self::$tableName.)
	*/
	public static string $tableName;
	
	/**
	* @var	array	expected format:  ['fieldName': value , 'fieldName': value , ... ]
	* ( ! i do not choose static, because each instance of the child class will have its own datas.
	* please access it using $this->rowDatas)
	*/
	protected array $rowDatas;

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		$this->rowDatas = [];
	}

	// =========================================
	// GETTERS-SETTERS
	// =========================================


	// Setters ----------------------------------

	public function set_rowDatas(array $arrayAssocForRowDatas)
	{
		$this->rowDatas = $arrayAssocForRowDatas;
	}

	// Getters ----------------------------------
	public function get_tableName()
	{
		if ( isset(self::$tableName) && !empty(self::$tableName) )
		{
			return self::$tableName;
		} else {
			return "";
		}
	}

	public function get_rowDatas()
	{
		return $this->rowDatas;
	}

	// =========================================
	// METHODS
	// =========================================

	/**
	*
	*/
	public function create (Mysqli $mysqli)
	{
		if ( empty(self::$tableName) || empty($this->rowDatas) )
		{
			throw new Exception('ERROR : We need both tableName and rowDatas to not be empty.');
		}
	
		$sql_query = "INSERT INTO ".self::$tableName;
		
		//--- prepare string "fieldname , fieldname , fieldname ..."
		$rowdDatasFieldsOnly = array_keys($this->rowDatas);
		$fieldsWithComma_str = implode(' , ', $rowdDatasFieldsOnly);
		
		//--- prepare string "value , value , value ..."
		$rowdDatasValuesOnly = array_values($this->rowDatas);
		$valuesWithComma_str = implode(' , ', $rowdDatasFieldsOnly);

		$sql_query .= " VALUES ( $valuesWithComma_str )";
		$sql_query .= ";" ;

		$mysqli_response = $mysqli->query($sql_query);

		// --- return true if mysqli_response was a success , and false if it wan't.
		return (!empty($mysqli_response) );
	}


	/**
	* @param	Mysqli	$mysqli				instance of Mysqli
	* @param 	int		$rowid				number of rowid to load (see concerned sql table)
	* @param 	array	$whereConditions	Expected format example: ["id = 5" , "year=1998" , "firstname LIKE 'christ%'"]
	* @return	bool	Return true if success and false if not.
	*/
	public function loadOne (Mysqli $mysqli , array $whereConditions = [])
	{
		$sql_query = "SELECT *";
		$sql_query .= " FROM ".self::$tableName;
		// $sql_query .= " WHERE (rowid = $rowid)";

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

		$this->rowDatas = $mysqli_response->fetch_assoc();
	}


	/**
	*
	*/
	public function update (Mysqli $mysqli)
	{
		$sql_query = "UPDATE ".self::$tableName;
		$sql_query .= " SET";

		$i = 1;
		foreach ($this->rowDatas as $fieldName => $value) {
			$sql_query .= " $fieldName = '$value'";

			if ($i < count($this->rowDatas))
			{
				$sql_query .= " ,";
			}

			$i++;
		}

		$rowid = $this->rowDatas['rowid'];

		$sql_query .= " WHERE rowid = $rowid";

		$mysqli_response = $mysqli->query($sql_query);

		echo '<script>console.info(`line_'.__LINE__.': $sql_query`); console.debug('.json_encode($sql_query).');</script>'; //! DEBUG
		
		/* if (!$mysqli_response)
		{
			throw new Exception("Mysqli n'a pas donné de réponse pour cette requête SQL :\n" . $sql_query);
		} */

		return true;
	}


	/**
	*
	*/
	public function delete (Mysqli $mysqli , $rowid)
	{
	
	}
}
?>