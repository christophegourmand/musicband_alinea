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
				$methodName = 'set_'.$fieldname;
				$this->$methodName($value);
			}
		}

		return true;
	}


}

?>