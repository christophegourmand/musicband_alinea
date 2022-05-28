<?php

require_once "Model.class.php";

class Usernew extends Model
{
	public function __construct()
	{
		parent::__construct('user');
		
		//--- check if tableName is ok :
		// echo (self::$tableName);
	}

}
