<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main class="">
    <h1 class="page-title">Photos</h1>

	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>

    <div class="gallery">
            
            <?php include("_gallery_loop.php"); ?>
        
    </div>

</main>
