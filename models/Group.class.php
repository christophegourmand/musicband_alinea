<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

class Group extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected string $groupname;
	private array $users;

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('group');

		// TODO : supprimer la propriété ci-dessous quand certain qu'elle n'est plus utilisée
		$this->rowDatas = []; // defined in Model.class.php
	}

	// =========================================
	// CRUD
	// =========================================

	// FONCTIONNE
	public function create(Mysqli $mysqli) :bool
	{
		try {
			$rowDatas = $this->prepareRowDatas();
			self::$dbHandler->insertRow($mysqli , $this->get_tableName() , $rowDatas);

		} catch (Exception $exception) {
			throw $exception;
		}
		return true;
	}

	// FONCTIONNE
	public function load(Mysqli $mysqli , int $rowid) :bool
	{
		try {
			//--- load the row so $receivedRowDatas will be full.
			$receivedRowDatas = self::$dbHandler->loadRow($mysqli , $this->get_tableName() , ["rowid = $rowid"]);


			//--- re-affect datas from rowDatas to each properties of this object
			$this->rowid = (int) $receivedRowDatas['rowid'];
			$this->groupname = (string) $receivedRowDatas['groupname'];
		} catch (\Throwable $th) {
			throw $th;
		}
		
		return true;
	}
	
	// FONCTIONNE
	public function update(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible d'updater un groupe si la propriété `rowid` n'est pas remplie.");
		}

		$rowDatas = $this->prepareRowDatas();
		$isUpdated = self::$dbHandler->updateRow($mysqli , $this->get_tableName() , $rowDatas , $this->rowid);
		return $isUpdated;
	}
	
	// FONCTIONNE
	public function delete(Mysqli $mysqli) :bool
	{
		if (empty($this->rowid))
		{
			throw new Exception("ERREUR: impossible de supprimer un groupe si la propriété `rowid` n'est pas remplie.");
		}

		$isDeleted = self::$dbHandler->deleteRow($mysqli , $this->get_tableName() , $this->rowid);

		return $isDeleted;
	}
	


//! ===== CI-DESSOUS : NON ADAPTÉS À Model et Modelable ========

	// =========================================
	// GETTERS-SETTERS
	// =========================================

	// Setters ----------------------------------
	
	// FONCTIONNE
	public function set_groupname(Mysqli $mysqli , string $given_groupname) : void
	{
		// --- vérifier que le nom donné n'est pas trop long (dans la DB j'ai mis VARCHAR(50) )
		if (strlen($given_groupname) > 50)
		{
			throw new Exception("ERREUR : Le nom donné pour le group doit être de 50 caractères max", 1);
		}


		$containBadCharacters = preg_match("/[^\w\_\-]/i", $given_groupname) ? true : false;
		if ($containBadCharacters)
		{
			throw new Exception("ERREUR : le nom de groupe donné contient des caractères autres que letters+digits+dash+underscore");
			;
		}

		$this->groupname = $given_groupname;
	}

	// Getters ----------------------------------

	// FONCTIONNE
	public function get_groupname() : string
	{
		return $this->groupname;
	}

	// TODO : A TESTER
	public function load_users(Mysqli $mysqli) : bool
	{
		try 
		{
			//--- verifie que le group a un rowid chargé
			if (empty($this->rowid))
			{
				throw new Exception("ERREUR: impossible de charger les users d'un groupe si la propriété `rowid` du groupe n'est pas remplie.");
			}

			$received_rowDatas_ofUsers = self::$dbHandler->loadManyRows($mysqli , 'user' , ["fk_group_rowid = $this->rowid"]);

			foreach ($received_rowDatas_ofUsers as $index => $user_rowDatas) {
				$newUser = new User();
				$newUser->load($mysqli , $user_rowDatas['rowid']);
				$this->users[] = $newUser;
			}
		} catch (Exception $exception)
		{
			throw $exception;
		}

		return true;
	}

	// TODO : A TESTER
	public function get_users() : array
	{
		return $this->users;
	}

	// =========================================
	// METHODS
	// =========================================

	// FONCTIONNE
	// --- sera utilisée pour `create` et pour `update`
	public function prepareRowDatas() : array
	{
		$rowDatas = [];
		
		//--- si non vide, on prend la valeur
		if (!empty($this->rowid))
			$rowDatas['rowid'] = $this->rowid; 

		//--- si vide, on renvoi une erreur , si non vide , on le prend
		if (empty($this->groupname))
		{
			throw new Exception("ERREUR: impossible de créer ou updater un user si la propriété `groupname` n'est pas remplie.");
		} else {
			$rowDatas['groupname'] = $this->groupname;
		}

		return $rowDatas;
	}


}


?>