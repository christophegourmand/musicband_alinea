<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
    <section class="bigquote">
        <blockquote class="bigquote-text" id="bigquote_on_index_page">Étrange.<br>Comme tout l’est.<br>Comme Nous sommes.<br>Toujours à deux doigts de vivre vraiment… Avec vous. Avec Nous. Avec soi-même.<br>Nous sommes nos chairs inconnues, nous sommes  « l’autrement », l’exception aux règles, ce que le bruit de vivre est au silence de nos solitudes, ce que la destination est au chemin, quand l’arrivée se dessine enfin, au loin.<br>À la fois le commencement, et à la fois la fin d’une nouvelle idée.<br>L’Alinéa a tout ça…</blockquote>
        <cite class="bigquote-author"></cite>
        <!-- CORRECTIONS: "Etrange" : É,  "sois-même" : soi-même,  "A la fois" : À  ,  "L'Alinéa à tout ça" : a -->
    </section>

    <?php include($_SERVER['DOCUMENT_ROOT']."/"."views/modules/socialmedia.php")?>

	<?php
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>

    <!-- <img class="img-full-page" src="assets/img/photos/from-CoppaStudio/2020.06.24/Color/SD/alinea_00027_groupe_SD.jpeg" alt="photo des membres du groupe de musique Alinea" title="photo des membres du groupe de musique Alinea"> -->
    <!-- update 21 juin :  -->
    <img class="img-full-page" src="assets/img/photos/for-pages/presentation-groupe-thierry-nico.jpg" alt="photo des membres fondateurs du groupe de musique Alinea" title="photo des membres fondateurs du groupe de musique Alinea">

</main>