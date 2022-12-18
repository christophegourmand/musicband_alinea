<?php 
    include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
    <h2 class="page-title">Partenaires</h2>

	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>

    <div class="partenaires-container">
        <section class="partenaires">
            <h3 class="partenaires-title">Alinéa.</h3>
            <div class="partenaires-body">
                <div class="partenaires-body_descriptions">
                    <p class="partenaires-description">La musique est ce qui nous anime, nous aimons en jouer, mais surtout la partager ! Donc n'hésitez pas à nous contacter pour une prestation musicale, un projet, ou même pour nous soutenir.</p>

                </div>
				<div class="partenaires-body_infos">
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="mailto:alineamusique@gmail.com">alineamusique@gmail.com</a>
                    </h4>
                    <div class="socialMedia-mini-link-container">
                            <a class="socialMedia-mini-link" href="https://www.facebook.com/Alineamusique" target="_blank">
                                <img class="socialMedia-mini-logo" src="<?='/assets/img/partners/facebook/f_logo_RGB-White_58.png'?>" alt="logo facebook" title="logo facebook">
                            </a>
                            <a class="socialMedia-mini-link" href="https://www.youtube.com/channel/UCKoysXy-RHdX1QtP4Ugr9Fw" target="_blank">
                                <img class="socialMedia-mini-logo" src="<?='/assets/img/partners/youtube/youtube_social_circle_dark.png'?>" alt="logo youtube" title="logo youtube">
                            </a>
                            <a class="socialMedia-mini-link" href="https://www.instagram.com/alineamusique/" target="_blank">
                                <img class="socialMedia-mini-logo" src="<?='/assets/img/partners/instagram/glyph-logo_May2016_modified_white_400px.png'?>" alt="logo instagram" title="logo instagram">
                            </a>
                    </div>
                </div>

            </div>
        </section>
        <section class="partenaires">
            <h3 class="partenaires-title"><a class="partenaires-link" href="https://www.coppastudio.fr/">Coppa Studio</a></h3>
            <div class="partenaires-body">
                <div class="partenaires-body_descriptions">
                    <p class="partenaires-description">Création et production de supports audiovisuels, films d'entreprises, événementiels, spots puoblicitaires, clips musicaux, courts métrages, films associatifs, projets personnels, culturels, institutionnels et mariages.</p>
                </div>
                <div class="partenaires-body_infos">
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="mailto:contact@coppastudio.fr">contact@coppastudio.fr</a>
                    </h4>
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://www.coppastudio.fr/" target="_blank">www.coppastudio.fr/</a>
                    </h4>
                </div>
            </div>
        </section>
        <section class="partenaires">
            <h3 class="partenaires-title"><a class="partenaires-link" href="https://www.odeva.fr">Odeva Publishing</a></h3>
            <div class="partenaires-body">
                <div class="partenaires-body_descriptions">
                    <p class="partenaires-description">Société indépendante d'édition musicale, basée en Franche-comté, créée en 2009, spécialisée dans la gestion des droits créatifs mais également dans l'organisation de concerts, le management, la régie, la formation professionnelle et le booking.</p>
                </div>
                <div class="partenaires-body_infos">
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="mailto:contact@odeva.fr">contact@odeva.fr</a>
                    </h4>
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://www.odeva.fr" target="_blank">www.odeva.fr</a>
                    </h4>
                </div>
            </div>
        </section>
        <section class="partenaires">
            <h3 class="partenaires-title"><a class="partenaires-link" href="mailto:christophe.gourmand@gmail.com">Christophe Gourmand</a></h3>

            <div class="partenaires-body">
                <div class="partenaires-body_descriptions">
                    <p class="partenaires-description">Développeur web Front-End et Back-End : réalisation de sites et applications web.</p>
                    <br>
                    <p class="partenaires-description">Compositeur et ingé-son : Production et mixage de musiques originales &#47; soundesign et habillage sonore.</p>
                </div>
                <div class="partenaires-body_infos">
                    <h4 class="partenaires-body_info">
                        <!-- <a class="partenaires-link" href="<?=$_SERVER['DOCUMENT_ROOT']."/".'controller/mailToChristopheGourmand.php'?>">me contacter</a> -->
                        <a class="partenaires-link" href="mailto:christophe.gourmand@gmail.com">me contacter</a>
                    </h4>
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://www.linkedin.com/in/christophe-gourmand-295b87164/" target="_blank">LinkedIn</a>
                    </h4>
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://github.com/christophegourmand" target="_blank">GitHub</a>
                    </h4>
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://codepen.io/saragone" target="_blank">CodePen</a>
                    </h4>
                </div>
            </div>

        </section>
        <section class="partenaires">
            <h3 class="partenaires-title"><a class="partenaires-link" href="https://www.jeveuxunartiste.fr">jeveuxunartiste.fr</a></h3>
            <div class="partenaires-body">
                <div class="partenaires-body_descriptions">
                    <p class="partenaires-description">Annuaire gratuit d'artistes (chanteurs, musiciens, DJ, cascadeur, clown, cracheur de feu, danseurs, ...) sur toute la France.</p>
                </div>
                <div class="partenaires-body_infos">
                    <!--
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="mailto:contact@odeva.fr">contact@odeva.fr</a>
                    </h4>
                    -->
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://www.jeveuxunartiste.fr" target="_blank">www.jeveuxunartistes.fr</a>
                    </h4>
                </div>
            </div>
        </section>
        <section class="partenaires">
            <h3 class="partenaires-title"><a class="partenaires-link" href="https://www.jeveuxunartiste.fr">LinkABand</a></h3>
            <div class="partenaires-body">
                <div class="partenaires-body_descriptions">
                    <p class="partenaires-description">Site pour trouver et réserver un groupe pour votre événement. Parmi les avantages de ce site : une recherche du groupe selon de nombreux critères et une liste très complète des informations logistiques indiquées par chaque groupe pour une organisation parfaite !</p>
                </div>
                <div class="partenaires-body_infos">
                    <h4 class="partenaires-body_info">
                        <a class="partenaires-link" href="https://linkaband.com/alinea?utm_source=badge&utm_campaign=43756" target="_blank">linkaband.com</a>
                    </h4>
                    <h4 class="partenaires-body_info">
						<!--Badge Linkaband généré le 28-11-2022; Copyright Linkaband 2019-->
						<a href='https://linkaband.com/alinea?utm_source=badge&utm_campaign=43756' target='_blank'>
							<img src='https://linkaband.com/assets/images/validation/reservation-noir.png' alt='Alinea' style='width: 90px; height: 90px;'/>
						</a>
                    </h4>
                </div>
            </div>
        </section>
    </div>
</main>