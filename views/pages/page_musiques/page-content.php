<?php include($prefix_to_root_folder.'datas/allSongs_variables.php')?>

<main>
    <h2 class="page-title">Musiques</h2>
    
    <section class="album">
        <h2 class="album-title">Madison<sup class="album-title-mention">1er&nbsp;album</sup></h2>

        <div class="album-layout">
            <img class="album-img album-img--shadow" src="<?php echo($prefix_to_root_folder.'/assets/img/photos/album_madison_book/00_PochetteAvant.jpg');?>" title="Pochette de l'album Madison" alt="Pochette de l'album Madison">
            
            <div class="musicPlateform">
                <p class="musicPlateform-message">Disponible sur vos plateformes favorites !</p>
                <div class="musicPlateform-plateforms">
                    <a href="#" class="musicPlateform-link">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/apple/FR_Apple_Music_Listen_on_Lockup_RGB_wht_090220.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a href="#" class="musicPlateform-link">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/deezer/fr_FR-dark.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a href="#" class="musicPlateform-link">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/apple/FR_iTunes_Store_Buy_Badge_RGB_011618.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a href="#" class="musicPlateform-link">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/from_imusiciandigital/logo_amazonmp3_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a href="#" class="musicPlateform-link">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/from_imusiciandigital/logo_google-play_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a href="#" class="musicPlateform-link">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/from_imusiciandigital/logo_tidal_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="songs">
        <aside class="songs-cards">
            <?php for($i=0 ; $i<count($allSongs_indArray) ; $i++): ?>
                <div class="horizontalCard <?='bg-song-'.$i?>" id="<?php echo('horizontalCard_song_'.$i);?>">
                    <a class="horizontalCard-link" href="<?php echo($prefix_to_root_folder.'views/pages/page_lyrics.php'.'?songClicked='.$i);?>">

                    <!-- .'/?song='.$i -->
                        <h3 class="horizontalCard-title"><?=$allSongs_indArray[$i]["song_title"]?></h3>
                    </a>
                </div>
            <?php endfor; ?>
        </aside>
    </section>
</main>