<?php 
    include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
    <h2 class="page-title">Actu</h2>
	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>
    
    <!--
    <section class="album">
        <h2 class="album-title">Madison<sup class="album-title-mention">1er&nbsp;album</sup></h2>

        <div class="album-layout">
            <img class="album-img album-img--shadow" src="<?php echo('/assets/img/photos/album_madison_book/00_PochetteAvant.jpg');?>" title="Pochette de l'album Madison" alt="Pochette de l'album Madison">
            
            <div class="musicPlateform">
                <p class="musicPlateform-message">Sortie de notre album MADISON le 1er Octobre 2020.</p>
                <br>
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
            </div>
        </div>
    </section>
    -->


    <section class="section section--actu">
        <h2 class="section-title">Les Jardins du rock</h2>
        <div class="section-content">
            <div class="section-content-text">
                <p class="section-content-text-message">Madison s’incruste dans votre salon! Le temps d’un concert privé, juste entre nous.</p>
                <p class="section-content-text-submessage">N’hésitez pas à nous contacter pour connaître nos grilles tarifaires.</p>
            </div>
            <img class="section-content-img" src="<?='/assets/img/flyers/alinea_00040_thierry-play-guitare_v2.jpg'?>" alt="Affiche pour Les Jardins du Rock" title="Affiche pour Les Jardins du Rock">
        </div>
    </section>

    <?php include($_SERVER['DOCUMENT_ROOT']."/"."views/modules/socialmedia.php")?>
</main>