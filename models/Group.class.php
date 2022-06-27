<?php
require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");

require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

class Group extends Model implements Modalable {

	// =========================================
	// PROPERTIES
	// =========================================
	protected string $groupname;
	private array $users;
	protected array $rights = [];

	// =========================================
	// CONSTRUCTOR
	// =========================================
	public function __construct()
	{
		//--- we use parent constructor AND pass tablename for the parent's property $tableName
		parent::__construct('group');

		// TODO : supprimer la propriété ci-dessous quand certain qu'elle n'est plus utilisée
		$this->rowDatas = []; // defined in Model.class.php

		//--- array for group rights initialized all to `false`
		$rights = 
			[
				'actu' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				'asso_group_right' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null // field `active` do not exists in this table
					],
				'asso_user_preference' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null // field `active` do not exists in this table
					],
				'bio' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],	
				'concert' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				'group' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null // field `active` do not exists in this table
					],
				'music_album' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				'music_song' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				'preference' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null // field `active` do not exists in this table
					],
				'product' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				'product_image' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				'right' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null // field `active` do not exists in this table
					],
				'user' => 
					[
						'can_create' => false,
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => false
					],
				//--- THOSE WHO ARE NOT IN DATABASE ---
				'albumphoto' => //--- concern folders, not database
					[
						'can_create' => false, //NOTE: here , `can_create` means in fact `can_add`
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null //NOTE: folder/files doesn't have `in/active` status, I had no choice but to add that field in database, but useless here.
					],
				'photo' => //--- concern files, not database
					[
						'can_create' => false, //NOTE: here , `can_create` means in fact `can_add`
						'can_see' => false,
						'can_modify' => false,
						'can_delete' => false,
						'can_activate' => null //NOTE: folder/files doesn't have `in/active` status, I had no choice but to add that field in database, but useless here.
					]
			];

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



	public function get_rightsForThisTable(Mysqli $mysqli, string $tablename)
	{
		//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadManyRows($mysqli , 'group_right' , ["`fk_group_rowid`={$this->get_rowid()}","`tablename`='{$tablename}'"]);

		// echo '<pre>';  @var_dump($receivedRowDatas);  echo '</pre>';  exit('END');    //! DEBUG

		/* --- ce qu'on reçoit :

			array (size=1)
				0 => 
					array (size=8)
					'rowid' => string '21' (length=2)
					'fk_group_rowid' => string '1' (length=1)
					'tablename' => string 'concert' (length=7)
					'can_create' => string '1' (length=1)
					'can_see' => string '1' (length=1)
					'can_modify' => string '1' (length=1)
					'can_delete' => string '1' (length=1)
					'can_activate' => string '1' (length=1)

			--- il faut alors recréer un array avec seulement les clé `'can_xxxxx' => valeur`]
		*/

		$receivedRowDatas = $receivedRowDatas[0];
		unset($receivedRowDatas['rowid']);
		unset($receivedRowDatas['fk_group_rowid']);
		unset($receivedRowDatas['tablename']);

		return $receivedRowDatas;
	}
	
	public function get_rightsForAllTables(Mysqli $mysqli)
	{
		//--- load the row so $receivedRowDatas will be full.
		$receivedRowDatas = self::$dbHandler->loadManyRows($mysqli , 'group_right' , ["`fk_group_rowid`={$this->get_rowid()}"]);

		// echo '<pre>';  @var_dump($receivedRowDatas);  echo '</pre>';  exit('END');    //! DEBUG

		/* --- ce qu'on reçoit :

			array (size=18)
				0 => 
					array (size=8)
					'rowid' => string '1' (length=1)
					'fk_group_rowid' => string '1' (length=1)
					'tablename' => string 'actu' (length=4)
					'can_create' => string '1' (length=1)
					'can_see' => string '1' (length=1)
					'can_modify' => string '1' (length=1)
					'can_delete' => string '1' (length=1)
					'can_activate' => string '1' (length=1)
				1 => ...etc
				2 => ...etc
				3 => ...etc
				
			--- il faut alors recréer un array avec seulement les clé `'can_xxxxx' => valeur`]
		*/



		/* --- we want :
			[
				'<nameOfTable>' => [
					'can_create' => true , 
					'can_see' => true , 
					'can_modify' => true , 
					'can_delete' => false
					'can_activate' => false
				],
				'<nameOfTable>' => [..etc..]
				'<nameOfTable>' => [..etc..]
			]
		*/
		//--- reorganise array so its keys will be tables names instead-of indexes
		$result = [];
		foreach ($receivedRowDatas as $row_assocArray) {
			$looping_tablename = $row_assocArray['tablename'];

			//--- the array `$row_assocArray` is store in $result['user'] or $result['concert'] or ...
			$result[$looping_tablename] = $row_assocArray;

			//--- we remove keys 'rowid' , 'tablename' , and 'fk_group_rowid' as now they are useless:

			unset($result[$looping_tablename]['rowid']);
			unset($result[$looping_tablename]['tablename']);
			unset($result[$looping_tablename]['fk_group_rowid']);
		}

		return $result;
	}

}


?>