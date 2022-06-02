<?php
interface Modalable {

	
	// TODO  [ ] fait pour user
	public function create(Mysqli $mysqli);

	// TODO  [x] fait pour user
	// TODO  [x] fait pour group
	public function load(Mysqli $mysqli , int $rowid);
	
	// TODO  [ ] fait pour user
	public function update(Mysqli $mysqli , int $rowid);
	
	// TODO  [ ] fait pour user
	public function delete(Mysqli $mysqli , int $rowid);
	
	// --- déplacé dans la classe parente Model.class.php (donc pas nécessaire dans chaque sous classe)
	public function set_rowDatas(Mysqli $mysqli , array $arrayAssocForRowDatas);
	
	// --- déplacé dans la classe parente Model.class.php (donc pas nécessaire dans chaque sous classe)
	public function get_rowDatas();

	// --- déplacé dans la classe parente Model.class.php (donc pas nécessaire dans chaque sous classe)
	public function set_rowid(int $given_rowid);

	// --- déplacé dans la classe parente Model.class.php (donc pas nécessaire dans chaque sous classe)
	public function get_rowid();

}

?>