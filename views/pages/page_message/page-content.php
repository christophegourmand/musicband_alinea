<?php 
	// REVIEW : réactiver si besoin
	# $newToken = ;
	# $_SESSION = 

	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

?>

<main>
	<h2 class="page-title">Message</h2>
	<?php 
		if ($_GET['messagekey'])
		{
			// en fonction de la clé , aller chrecher le message dans un array
			
			$message = displayMessageFromKey($_GET['messagekey']);
		}
	?>

	<div class="message">
		<?= $message ?>
	</div>
</main>