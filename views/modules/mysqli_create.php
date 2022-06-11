<?php
require($_SERVER['DOCUMENT_ROOT']."/.env.php");

if (!isset($mysqli) || empty($mysqli)){
	$mysqli = new Mysqli($db_serveur, $db_username, $db_userpass, $db_name);

	//--- vérifie le character set de la database avant changement
	# echo '<script>console.info(`line_'.__LINE__.': Initial Character Set:'.$mysqli->character_set_name().'`);</script>'; // DEBUG

	//--- modify character set in database to fix accent not being displayed in view page
	$mysqli->set_charset("utf8");
				// LINK : https://programmation-web.net/2010/11/comment-resoudre-les-problemes-daccents/
	
	//--- vérifie le character set de la database après changement
	#echo '<script>console.info(`line_'.__LINE__.': Initial Character Set:'.$mysqli->character_set_name().'`);</script>'; // DEBUG
}

// Check connection
if ($mysqli->connect_errno) {
	// echo "Failed to connect to MySQL: " . $mysqli->connect_error;

	echo '<script>console.info(`line_'.__LINE__.': $mysqli->connect_error`); console.debug('.json_encode($mysqli->connect_error).');</script>'; //! DEBUG
	exit();
}

?>