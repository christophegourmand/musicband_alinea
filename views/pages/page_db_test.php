<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

?>


<!DOCTYPE html>
<html>
<!-- <head>
	<meta charset="UTF-8">
	<title>page_db_test.php</title>
	<style>
		* {
			font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		}
	</style>
</head> -->

<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/head.php"); ?>

<body>
	<h1>Page db test</h1>
	
	<main>
		<?php
			require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/models/AlbumsContainer.class.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/models/Usernew.class.php");

			use models\music\AlbumsContainer;
			use models\music\MusicAlbum as MusicAlbum;

			// TEST : récupérer un album de music , et que les variables d'instances soient remplies.
			/*
			$musicalbum1 = new MusicAlbum();
			$musicalbum1->loadFromDbById($mysqli, 1);
																	var_dump($musicalbum1);
			*/

			// TEST : updater un musicAlbum
			/* 
			$musicalbum1 = new MusicAlbum();
			$musicalbum1->loadFromDbById($mysqli, 1);
																	// var_dump($musicalbum1);
			$musicalbum1->set_name('Madison');
																	// var_dump($musicalbum1);
			$musicalbum1->updateIntoDb($mysqli); 
			*/

			// TEST : je recupere depuis la db l'album qui a été updaté
			/* 
			$musicalbum1_verif = new MusicAlbum();
			$musicalbum1_verif->loadFromDbById($mysqli, 1); 
			*/
																	// var_dump($musicalbum1_verif);

			// TEST : je teste la classe AlbumsContainer
			/* 
			$albumsContainer = new AlbumsContainer();
			$albumsContainer->loadMusicAlbumsFromDb($mysqli); 
			*/
							// echo '<pre>';  @var_dump( $albumsContainer->get_albums() );  echo '</pre>';  //exit('END');    //! DEBUG

			// TEST - je teste la méthode `loadSongsFromDbById()` de la classe MusicAlbum
			/* $musicalbum1_avecSongs = new MusicAlbum();
			$musicalbum1_avecSongs->loadFromDbById($mysqli , 1);
			$musicalbum1_avecSongs->loadSongsFromDbById($mysqli , 1);
							echo '<pre>';  @var_dump($musicalbum1_avecSongs);  echo '</pre>';  //exit('END');    //! DEBUG

			require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php"); */

			$usernew = new Usernew();
			// var_dump($usernew->get_tableName());
			$usernew->loadOne($mysqli , ["login LIKE 'ni%'", "rowid > 1"]);
			
			echo '<pre>';  @var_dump($usernew);  echo '</pre>';  //exit('END');    //! DEBUG

			$usernew->set_rowDatas(
				[
					'rowid'=> 2,
					'login'=> 'nini',
					'pass' => 'nini_micro3',
					'pass_encoded' => '',
					'datecreation' => '2022-04-03 21:50:49',
					'datelastconnection' => '2022-04-03 21:50:49',
					'active' => '1'
				]
			);

			$usernew->update($mysqli);
			

			// var_dump($usernew);

		?>
	</main>
</body>
</html>

<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");
?>