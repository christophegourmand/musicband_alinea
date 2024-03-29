<?php 
	// TODO : supprimer la ligne quand je récupère tout depuis la database
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	// require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");

	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

	//--- create instances of MusicSong and MusicAlbum , and fill them
	$musicSong = new MusicSong();
	$songToDisplay_rowid = (isset( $_GET['songRowid']) && !empty ($_GET['songRowid'])) ? $_GET['songRowid'] : 1;
	$musicSong->load($mysqli , $songToDisplay_rowid);

	$rowid_albumContainingSong = $musicSong->get_fk_album_rowid();

	$musicAlbum = new MusicAlbum();
	$musicAlbum->load($mysqli , $rowid_albumContainingSong);

	// TODO : AJOUTER DANS LA DATABASE `position_dans_album`


?>

<main>
	<h2 class="page-title">Musiques</h2>

	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>

	<section class="album">
		<h2 class="album-title">Album <?= $musicAlbum->get_name() ?></h2>
	</section>

	<section class="songs">

		<aside class="songs-song-banner">
				<div 
					class="horizontalCard" 
					id="<?= 'musicsong_rowid_'.$musicSong->get_rowid() ?>" 
					data-bg-img="<?= $musicSong->get_path_image() ?>"
				>
					<a class="horizontalCard-btn btn-dark" href="<?='/views/pages/page_musiques.php';?>">
						<span class="btn-txt">&lt;</span>
					</a>
					<a class="horizontalCard-link" href="<?='/views/pages/page_musiques.php';?>">
						<h3 class="horizontalCard-title horizontalCard-title--big"><?= $musicSong->get_name() ?></h3>
					</a>
				</div>
		</aside>

		<?php 
			if ( !empty($musicSong->get_path_mp3()) ) 
			{
				$song_mp3_source_str = $musicSong->get_path_mp3();
				include($_SERVER['DOCUMENT_ROOT']."/".'views/modules/audio_player.php');
			}
		?>

		<article class="lyrics white">
			<?php
				//--- methode 1 : separer par ligne
				# $lyricsLinesArray = preg_split('/\R/' , $musicSong->get_lyrics()) ;
				# var_dump($lyricsLinesArray);
				# foreach ($lyricsLinesArray as $LyricsLine) {
				# 	if (str)
				# }
				
				//--- remplace les underscores __xxxx__ par <strong>xxxx</strong>
				$lyricsLinesFormated = preg_replace('/__(.*)__/i', '<strong>${1}</strong>', $musicSong->get_lyrics());

				//--- remplace les sauts de lignes par la balise <br>
				$lyricsLinesFormated = preg_replace('/\R/', '<br>', $lyricsLinesFormated);
			?>
			<p class="lyrics-formated">
				<?php 
					echo ( $lyricsLinesFormated );
				?>
			</p>
		</article>
	</section>

</main>