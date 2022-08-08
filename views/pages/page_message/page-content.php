<?php 
	// REVIEW : réactiver si besoin
	# $newToken = ;
	# $_SESSION = 

	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

?>

<main>
	<h2 class="page-title">Message</h2>
	
	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php");
	?>

</main>