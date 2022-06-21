<?php 
    include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
    require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
    <h2 class="page-title">À propos</h2>
	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>
    <div class="mentions-legales">
        <p class="mentions-legales-text">Ce site n'utilise pas de cookies. En effet, nous n'avons nul besoin de mémoriser vos préférences ou vos réglages. Nous ne receuillons pas d'informations vous concernant. C'est pour cela que nous ne verrez pas de message vous informant d'un quelconque placement de 'cookies' dans le navigateur de votre appareil.</p>
        <br>
        <p class="mentions-legales-text">Le webmaster.</p>
    </div>
</main>