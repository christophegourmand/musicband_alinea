<?php 
    include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');

?>

<main>
    <h2 class="page-title">Plan du site</h2>

    <section class="sitemap">
        <ul class="sitemap-list-level1">
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="/">Accueil</a>
            </li>
            
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_musiques.php');?>">Musiques</a>
                
                <ul class="sitemap-list-level2">
                    <?php for($i=0 ; $i<count($allSongs_indArray) ; $i++): ?>
                        <li class="sitemap-item-level2">
                            <a class="sitemap-link" href="<?php echo('/views/pages/page_lyrics.php'.'?songClicked='.$i);?>">
                                Paroles : <?=$allSongs_indArray[$i]["song_title"]?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </li>

            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_photos.php'); ?>">Photos</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_actu.php');?>">Actu</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_tour.php');?>">Tour , Concerts</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_contact.php');?>">Contact</a>
            </li>
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_bio.php');?>">Bio</a>
            </li>
            <!--
            <li class="sitemap-item-level1">
                <a class="sitemap-link" href="<?php echo('/views/pages/page_acheter.php');?>">Acheter</a>
            </li>
            -->
        </ul>        
    </section>
</main>