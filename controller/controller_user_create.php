<?php 
	var_dump($_REQUEST); // DEBUG

/* 	if (isset($_POST['action']) && $_POST['action'] == 'sendform'){
		print_r($_POST);
	}
 */

	// --- check if session from form is the same as the sessionid in client browser.
	if ($_POST['sessionid'] === session_id()){
		$user = new User ();
	}

 ?>