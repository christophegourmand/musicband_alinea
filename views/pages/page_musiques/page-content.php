<?php include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php')?>

<main>
    <h2 class="page-title">Musiques</h2>
    
    <section class="album">
        <h2 class="album-title">Madison<sup class="album-title-mention">1er&nbsp;album</sup></h2>

        <div class="album-layout">
            <img class="album-img album-img--shadow" src="<?php echo('/assets/img/photos/album_madison_book/00_PochetteAvant.jpg');?>" title="Pochette de l'album Madison" alt="Pochette de l'album Madison">
            
            <div class="musicPlateform">
                <p class="musicPlateform-message">Disponible sur vos plateformes favorites&nbsp;!</p>
                <div class="musicPlateform-plateforms">
                    <!-- SPOTIFY -->
                    <a class="musicPlateform-link" href="https://open.spotify.com/album/5tUsiwIBO4IZFMte8EkkcO?si=28KYkyTjSXebE2GWhxlysQ" target="_blank">
                        <img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/spotify/Spotify_Logo_RGB_Green.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <!-- <button class="musicPlateform-button">Ecouter</button> -->
                    </a>
                    <!-- APPLE MUSIC -->
                    <a class="musicPlateform-link" href="https://music.apple.com/fr/album/1531322642?uo=4&app=music&at=1001l34Ux&lId=22318004&cId=none&sr=1&src=Linkfire&itscg=30440&itsct=catchall_p1&ct=LFV_2805aead92b6e14097073b3071c592dd&ls=1" target="_blank">
                        <img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/apple/FR_Apple_Music_Listen_on_Lockup_RGB_wht_090220.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <!-- <button class="musicPlateform-button">Ecouter</button> -->
                    </a>
                    <!-- ITUNES -->
                    <a class="musicPlateform-link" href="https://itunes.apple.com/fr/album/1531322642?uo=4&app=itunes&at=1001l34Ux&lId=22318004&cId=none&sr=3&src=Linkfire&itscg=30440&itsct=catchall_p3&ct=LFV_2805aead92b6e14097073b3071c592dd&ls=1" target="_blank">
                        <img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/apple/FR_iTunes_Store_Buy_Badge_RGB_011618.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale"> 
                        <!-- <button class="musicPlateform-button">Ecouter</button> -->
                    </a>
                    <!-- DEEZER -->
                    <a class="musicPlateform-link" href="https://www.deezer.com/album/172483402?app_id=140685&utm_source=partner_linkfire&utm_campaign=2805aead92b6e14097073b3071c592dd&utm_medium=Original&utm_term=objective-stream&utm_content=album-172483402" target="_blank">
                        <img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/deezer/fr_FR-dark.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <!-- <button class="musicPlateform-button">Ecouter</button> -->
                    </a>
                    <!-- AMAZON MUSIC -->
                    <a class="musicPlateform-link" href="https://amazon.fr/dp/B08HSDWK6X?tag=imusician05-21&ie=UTF8&linkCode=as2&ascsubtag=2805aead92b6e14097073b3071c592dd" target="_blank">
                        <img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/from_imusiciandigital/logo_amazonmp3_onlight.svg');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <!-- <button class="musicPlateform-button">Ecouter</button> -->
                    </a>
                
                    <!-- GOOGLE PLAY -->
                    <a class="musicPlateform-link" href="https://play.google.com/store/music/album/Alin%C3%A9a_Madison?id=Ba4yvl3rhoeyh4o6kjnsc2pwh3y&PCamRefID=LFV_1c459a9ca8eb5ef05589b2ae73a5fece&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" target="_blank">
                        <img  class="musicPlateform-logo" src="<?php echo('/assets/img/partners/google_play/fr_badge_web_generic_cropped.png');?>" alt="Disponible sur Google Play"/>
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>

                    <!-- TIDAL -->
                    <a class="musicPlateform-link" href="http://listen.tidalhifi.com/album/154990559" target="_blank">
                        <img class="musicPlateform-logo" src="<?php echo('/assets/img/partners/tidal/Tidal-music_logo_white.png');?>" alt="logo plateforme musicale" title="logo plateforme musicale">
                        <button class="musicPlateform-button">Ecouter</button>
                    </a>
                </div>
            </div> <!-- END : musicPlateform-->
        </div>
    </section>

    <section class="songs">
        <h3 class="page-title">Paroles</h3>
        <aside class="songs-cards">
            <?php for($i=0 ; $i<count($allSongs_indArray) ; $i++): ?>
                <div class="horizontalCard <?='bg-song-'.$i?>" id="<?php echo('horizontalCard_song_'.$i);?>">
                    <a class="horizontalCard-link" href="<?php echo('/views/pages/page_lyrics.php'.'?songClicked='.$i);?>">

                    <!-- .'/?song='.$i -->
                        <h3 class="horizontalCard-title"><?=$allSongs_indArray[$i]["song_title"]?></h3>
                    </a>
                </div>
            <?php endfor; ?>
        </aside>
    </section>

    <section class="album">
        <h2 class="album-title">Nouveaux morceaux</h2>
    </section>

    <section class="songs">
        <h3 class="page-title">Paroles</h3>
        <aside class="songs-cards">
            <!--  -->
        </aside>
    </section>

</main>