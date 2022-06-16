<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");

	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");

    $dbHandler = new DbHandler();
    $albumsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'music_song', ["active = 1"]);

    // var_dump($albumsRowsFromDb);

    $listOfSongsRowids = [];
    foreach ($albumsRowsFromDb as $index => $rowDatas) {
        $listOfSongsRowids[] = $rowDatas['rowid'];
    }
?>

<main>
    <h2 class="page-title">Plan du site</h2>

    <section class="sitemap">
        <ul class="sitemap-list-level1">
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="/">Accueil</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_actu.php');?>">Actu</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_tour.php');?>">Tour , Concerts</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_musiques.php');?>">Musiques</a>
                <ul class="sitemap-list-level2">
                    <?php  foreach ($albumsRowsFromDb as $index => $rowDatas):?>
                        <li class="sitemap-item-level2">
                            <a class="sitemap-link" href="<?php echo('/views/pages/page_lyrics.php'.'?songRowid='.$rowDatas['rowid']);?>">
                                Paroles : <?= $rowDatas['name'] ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_photos.php'); ?>">Photos</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_bio.php');?>">Bio</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_contact.php');?>">Contact</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_partenaires.php');?>">Partenaires</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_metronome2.php');?>">Metronome</a>
            </li>
            <!--
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php # echo('/views/pages/page_acheter.php');?>">Acheter</a>
            </li>
            -->
        </ul>        
    </section>
</main>