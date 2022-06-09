<?php
interface Modalable {

	
	public function create(Mysqli $mysqli) :bool;

	public function load(Mysqli $mysqli , int $rowid) :bool;
	
	public function update(Mysqli $mysqli) :bool;
	
	public function delete(Mysqli $mysqli) :bool;

	// --- déplacé dans la classe parente Model.class.php (donc pas nécessaire dans chaque sous classe)
	public function set_rowid(int $given_rowid) : void;

	// --- déplacé dans la classe parente Model.class.php (donc pas nécessaire dans chaque sous classe)
	public function get_rowid() :int;
}

?>