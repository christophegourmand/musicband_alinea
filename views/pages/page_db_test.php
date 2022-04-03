<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/db_create.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");

	use models\music\MusicAlbum as MusicAlbum;

	$musicalbum1 = new MusicAlbum();
	$musicalbum1->fill_from_db($mysqli, 1);

	var_dump($musicalbum1);

?>