<?php
class Group extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	private string $groupname;
	private array $users;

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('group');
		$this->rowDatas = []; // defined in Model.class.php
	}

	// =========================================
	// CRUD
	// =========================================

	public function create(Mysqli $mysqli)
	{
		return "group a été créé";
	}

	public function load(Mysqli $mysqli , int $rowid)
	{
		try {
			//--- load the row so $this->rowDatas will be full.
			self::$dbHandler->loadRow($mysqli , $this , ["rowid = $rowid"]);

			//--- re-affect datas from rowDatas to each properties of this object
			$this->rowid = (int) $this->rowDatas['rowid'];
			$this->groupname = (string) $this->rowDatas['groupname'];
		} catch (\Throwable $th) {
			throw $th;
		}
		
		return true;
	}
	
	public function update(Mysqli $mysqli , int $rowid)
	{
		return "group a été updaté";
	}
	
	public function delete(Mysqli $mysqli , int $rowid)
	{
		return "group a été deleté";
	}
	


//! ===== CI-DESSOUS : NON ADAPTÉS À Model et Modelable ========

	// =========================================
	// GETTERS-SETTERS
	// =========================================

	// Setters ----------------------------------
	
	// --- FONCTIONNE
	public function set_groupname(Mysqli $mysqli , string $given_groupname)
	{
		// --- vérifier que le nom donné n'est pas trop long (dans la DB j'ai mis VARCHAR(50) )
		if (strlen($given_groupname) <= 50)
		{
			$this->groupname = $given_groupname;
		} else {
			throw new Exception("ERREUR : Le nom donné pour le group doit être de 50 caractères max", 1);
		}
	}

	// Getters ----------------------------------

	// TODO : A TESTER
	public function get_groupname()
	{
		return $this->groupname;
	}

	// TODO : A TESTER
	public function get_users()
	{
		return $this->users;
	}

	// =========================================
	// METHODS
	// =========================================

}


?>