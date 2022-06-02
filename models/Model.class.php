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

	/**
	* @var	array	expected format:  ['fieldName': value , 'fieldName': value , ... ]
	* ( ! i do not choose static, because each instance of the child class will have its own datas.
	* please access it using $this->rowDatas)
	*/
	protected array $rowDatas;

	protected static $dbHandler;

	public function __construct(string $given_tableName)
	{
		$this->tableName = $given_tableName;
		self::$dbHandler = new DbHandler();
	}

	//--- pas besoin de setter
	public function get_tableName()
	{
		if ( isset($this->tableName) && !empty($this->tableName) )
		{
			return $this->tableName;
		} else {
			return "";
		}
	}



	//* FONCTIONNE
	public function set_rowDatas(Mysqli $mysqli , array $arrayAssocForRowDatas)
	{
		// TODO : vérifier et activer ce code
		foreach ($arrayAssocForRowDatas as $key => $value) {
			if ( gettype( $value ) === 'string' )
			{
				//! to avoid SQL injection :
				$this->rowDatas[$key] = mysqli_real_escape_string($mysqli , $value); // NOTE : pour éviter l'injection sql
			} else
			{
				$this->rowDatas[$key] = $value; //--- for every other types than 'string'
			}

		}
		
		// $this->rowDatas = $arrayAssocForRowDatas;
	}
	
	// --- FONCTIONNE
	public function get_rowDatas()
	{
		return $this->rowDatas;
	}

	// TODO : A TESTER
	public function set_rowid(int $given_rowid)
	{
		$this->rowid = $given_rowid;
	}

	// TODO : A TESTERX
	public function get_rowid()
	{
		return $this->rowid;
	}


}

?>