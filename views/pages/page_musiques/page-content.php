<?php 
	//--- imports
	
	// TODO : supprimer la ligne quand je récupère tout depuis la database
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');

	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");

	//--- load MusicAlbums rowDatas
	$dbHandler = new DbHandler();
	$albumsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'music_album', ["active = 1"]);

	//--- create array of MusicAlbum instances and fill them with datas
	$musicAlbums_list = [];
	foreach ($albumsRowsFromDb as $albumRowFromDb) {
		# var_dump($albumRowFromDb);
		$musicAlbum = new MusicAlbum();
		$musicAlbum->fill_from_array($albumRowFromDb);
		$musicAlbum->load_musicSongs($mysqli);
		array_push($musicAlbums_list , $musicAlbum);
	}

	//--- for each MusicAlbum instance , load the MusicSongs instances


	/* foreach ($musicAlbums_list as $index => $musicAlbum) {
		echo '<pre>';  @var_dump($musicAlbum);  echo '</pre>';  //exit('END');    //! DEBUG
	} */

?>


<main>
	<h2 class="page-title">Musiques</h2>
	
	<!-- TODO - DEBUT FOREACH -->
	<?php  foreach ($musicAlbums_list as $musicAlbum) :?>
		<section class="album">

				<h2 class="album-title"><?= $musicAlbum->get_name() ?></h2>

				<div class="album-layout">
					<img class="album-img album-img--shadow" src="<?= $musicAlbum->get_path_image()?>" title="Pochette de l'album <?= $musicAlbum->get_name()?>" alt="Pochette de l'album  <?= $musicAlbum->get_name()?>">
					
					<div class="musicPlateform">
						<!-- <p class="musicPlateform-message">Disponible sur vos plateformes favorites&nbsp;!</p> -->
						<div class="musicPlateform-plateforms">
							<!-- SPOTIFY -->
							<?php if( !empty($musicAlbum->get_link_spotify()) ) :?>
								<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_spotify() ?>" target="_blank">
									<img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/spotify/Spotify_Logo_RGB_Green.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
									<!-- <button class="musicPlateform-button">Ecouter</button> -->
								</a>
							<?php endif ?>

							<!-- APPLE MUSIC -->
							<?php if( !empty($musicAlbum->get_link_applemusic()) ) :?>
							<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_applemusic() ?>" target="_blank">
								<img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/apple/FR_Apple_Music_Listen_on_Lockup_RGB_wht_090220.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
								<!-- <button class="musicPlateform-button">Ecouter</button> -->
							</a>
							<?php endif ?>

							<!-- ITUNES -->
							<?php if( !empty($musicAlbum->get_link_itunes()) ) :?>
							<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_itunes() ?>" target="_blank">
								<img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/apple/FR_iTunes_Store_Buy_Badge_RGB_011618.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale"> 
								<!-- <button class="musicPlateform-button">Ecouter</button> -->
							</a>
							<?php endif ?>

							<!-- DEEZER -->
							<?php if( !empty($musicAlbum->get_link_deezer()) ) :?>
							<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_deezer() ?>" target="_blank">
								<img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/deezer/fr_FR-dark.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
								<!-- <button class="musicPlateform-button">Ecouter</button> -->
							</a>
							<?php endif ?>

							<!-- AMAZON MUSIC -->
							<?php if( !empty($musicAlbum->get_link_amazonmusic()) ) :?>
							<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_amazonmusic() ?>" target="_blank">
								<img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/from_imusiciandigital/logo_amazonmp3_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
								<!-- <button class="musicPlateform-button">Ecouter</button> -->
							</a>
							<?php endif ?>

							<!-- GOOGLE PLAY -->
							<?php if( !empty($musicAlbum->get_link_googleplay()) ) :?>
							<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_googleplay() ?>" target="_blank">
								<img  class="musicPlateform-logo" src="<?php echo('/assets/img/partners/google_play/fr_badge_web_generic_cropped.png');?>" alt="Disponible sur Google Play"/>
								<button class="musicPlateform-button">Ecouter</button>
							</a>
							<?php endif ?>


							<!-- TIDAL -->
							<?php if( !empty($musicAlbum->get_link_tidal()) ) :?>
							<a class="musicPlateform-link" href="<?= $musicAlbum->get_link_tidal() ?>" target="_blank">
								<img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/tidal/Tidal-music_logo_white.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
								<button class="musicPlateform-button">Ecouter</button>
							</a>
							<?php endif ?>
						</div>
					</div> <!-- END : musicPlateform-->
				</div>
		</section>

		<section class="songs">
			<h3 class="page-title">Titres</h3>
			<aside class="songs-cards">
				<?php # for($i=0 ; $i<count($allSongs_indArray) ; $i++): ?>
				<?php foreach ($musicAlbum->get_musicSongs() as $musicSongindex => $musicSong): ?>
					<?php 
						//--- create string `albumRowid_songRowid` to use as id and css class
						$musicAlbumid_musicSongid = $musicAlbum->get_rowid() .'_'. $musicSong->get_rowid();
					?>


					<div class="horizontalCard <?='bg-song-'.$musicAlbumid_musicSongid?>" id="<?php echo('horizontalCard_song_'.$musicAlbumid_musicSongid);?>">
						<a class="horizontalCard-link" href="<?php echo('/views/pages/page_lyrics.php'.'?songRowid='.$musicSong->get_rowid());?>">

						<!-- .'/?song='.$i -->
							<h3 class="horizontalCard-title"><?= $musicSong->get_name() ?></h3>
						</a>
					</div>
				<?php # endfor; ?>
				<?php endforeach ?>
			</aside>
		</section>
	<?php  endforeach ?>
	<!-- TODO - FIN FOREACH -->

</main>