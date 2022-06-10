<?php 
	// TODO : supprimer la ligne quand je récupère tout depuis la database
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");


	// REVIEW : old version
	if ( !isset($_GET['songClicked']) || $_GET['songClicked'] == null )
	{
		$songToDisplay_nbr = 0;
	}
	else 
	{
		$songToDisplay_nbr = $_GET['songClicked'];
	}

	$song_assoArr = $allSongs_indArray[$songToDisplay_nbr];
	$song_title_str = $song_assoArr['song_title'];
	$lyrics_paragraphs_indArr = $song_assoArr["song_lyrics_paragraphs"];

	// SECTION - New version
	$musicSong = new MusicSong();
	$musicSong->load($mysqli , $_GET['songRowid']);

	$rowid_albumContainingSong = $musicSong->get_fk_album_rowid();

	$musicAlbum = new MusicAlbum();
	$musicAlbum->load($mysqli , $rowid_albumContainingSong);

	// TODO : AJOUTER DANS LA DATABASE `position_dans_album`



?>

<main>
	<h2 class="page-title">Musiques</h2>

	<section class="album">
		<h2 class="album-title">Album <?= $musicAlbum->get_name() ?></h2>
	</section>

	<section class="songs">

		<aside class="songs-song-banner">
				<div class="horizontalCard <?='bg-song-'.$songToDisplay_nbr;?>" id="<?='horizontalCard_song_'.$songToDisplay_nbr;?>">
					<a class="horizontalCard-btn btn-outline-white" href="<?='/views/pages/page_musiques.php';?>">
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
				
				//--- methode 2 : remplacer les underscores __xx xx xxxx__ par des tags html
				$lyricsLinesFormated = preg_replace('/__(.*)__/i', '<strong>${1}</strong>', $musicSong->get_lyrics());

				$lyricsLinesFormated = preg_replace('/\R/', '<br>', $lyricsLinesFormated);
				// var_dump($lyricsLinesFormated);

				// NOTE : problème Les accents ne sont pas affichés
				// LINK : https://programmation-web.net/2010/11/comment-resoudre-les-problemes-daccents/

				# mb_internal_encoding('UTF-8'); // TEST - essai pour corriger les accents
			?>
			<p class="lyrics-formated">
				<?php 
					# echo (utf8_decode($lyricsLinesFormated)); // TEST - n'a pas corrigé les accents
					# echo (iconv( 'UTF-8', 'ISO-8859-15', $lyricsLinesFormated) );
					echo ( $lyricsLinesFormated );
				?>
			</p>


			<hr>
			<!-- TODO : supprimer ci-dessous quand au-dessus fonctionne -->
			<?php for ($paragraph_index = 0 ; $paragraph_index < count($lyrics_paragraphs_indArr) ; $paragraph_index++): ?>
				<?php $paragraph_sentences_indArr = $lyrics_paragraphs_indArr[$paragraph_index]['sentences']; ?>
				<?php $paragraph_type_str = $lyrics_paragraphs_indArr[$paragraph_index]['type']; ?>

				<p class="lyrics-paragraph <?=$paragraph_type_str;?> ">
					<?php for($sentence_index = 0 ; $sentence_index < count($paragraph_sentences_indArr) ; $sentence_index++): ?>
						<span class="lyrics-sentence"> <?php echo($paragraph_sentences_indArr[$sentence_index]);?> </span>
						<br>
					<?php endfor; ?>
				</p>
				<br>
			<?php endfor; ?>

		</article>
	</section>

</main>