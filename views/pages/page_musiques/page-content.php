<?php include($prefix_to_root_folder.'datas/allSongs_variables.php')?>

<main>
    <h2 class="page-title">Musiques</h2>
    
    <section class="album">
        <h2 class="album-title">Madison<sup class="album-title-mention">1er&nbsp;album</sup></h2>

        <div class="album-layout">
            <img class="album-img album-img--shadow" src="<?php echo($prefix_to_root_folder.'/assets/img/photos/album_madison_book/00_PochetteAvant.jpg');?>" title="Pochette de l'album Madison" alt="Pochette de l'album Madison">
            
            <div class="musicPlateform">
                <p class="musicPlateform-message">Disponible sur vos plateformes favorites&nbsp;!</p>
                <div class="musicPlateform-plateforms">
                    <a class="musicPlateform-link" href="#">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/apple/FR_Apple_Music_Listen_on_Lockup_RGB_wht_090220.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a class="musicPlateform-link" href="#">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/apple/FR_iTunes_Store_Buy_Badge_RGB_011618.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale"> 
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a class="musicPlateform-link" href="#">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/deezer/fr_FR-dark.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <a class="musicPlateform-link" href="#">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/from_imusiciandigital/logo_amazonmp3_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    <!--
                    <a class="musicPlateform-link" href="#">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/from_imusiciandigital/logo_google-play_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    -->
                    <!--
                    <a class="musicPlateform-link" href='https://play.google.com/store/music/album/Alin%C3%A9a_Madison?id=Ba4yvl3rhoeyh4o6kjnsc2pwh3y&PCamRefID=LFV_1c459a9ca8eb5ef05589b2ae73a5fece&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
                        <img  class="musicPlateform-logo" alt='Disponible sur Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/fr_badge_web_generic.png'/>
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                    -->
                    <a class="musicPlateform-link" href='https://play.google.com/store/music/album/Alin%C3%A9a_Madison?id=Ba4yvl3rhoeyh4o6kjnsc2pwh3y&PCamRefID=LFV_1c459a9ca8eb5ef05589b2ae73a5fece&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
                        <img  class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/google_play/fr_badge_web_generic_cropped.png');?>" alt="Disponible sur Google Play"/>
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>

                    <a class="musicPlateform-link" href="#">
                        <img class="musicPlateform-logo" src="<?php echo($prefix_to_root_folder.'/assets/img/partners/tidal/Tidal-music_logo_white.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="songs">
        <h3 class="page-title">Paroles</h3>
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