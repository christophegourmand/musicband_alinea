<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/AlbumsContainer.class.php");

use models\music\AlbumsContainer;
use models\music\MusicAlbum as MusicAlbum;

	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");


	// TEST : récupérer un album de music , et que les variables d'instances soient remplies.
	/*
	$musicalbum1 = new MusicAlbum();
	$musicalbum1->loadFromDbById($mysqli, 1);
	var_dump($musicalbum1);
	*/

	// TEST : updater un musicAlbum
	$musicalbum1 = new MusicAlbum();
	$musicalbum1->loadFromDbById($mysqli, 1);
	var_dump($musicalbum1);
	$musicalbum1->set_name('Madison');
	var_dump($musicalbum1);
	$musicalbum1->updateIntoDb($mysqli);

	// TEST : je recupere depuis la db l'album qui a été updaté
	$musicalbum1_verif = new MusicAlbum();
	$musicalbum1_verif->loadFromDbById($mysqli, 1);
	var_dump($musicalbum1_verif);

	// TEST : je teste la classe AlbumsContainer
	$albumsContainer = new AlbumsContainer();
	$albumsContainer->loadMusicAlbumsFromDb($mysqli);
	echo '<pre>';  @var_dump( $albumsContainer->get_albums() );  echo '</pre>';  //exit('END');    //! DEBUG


	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");
?>