<?php
require($_SERVER['DOCUMENT_ROOT']."/.env.php");

if (!isset($mysqli) || empty($mysqli)){
	$mysqli = new mysqli($db_serveur, $db_username, $db_userpass, $db_name);
}

// Check connection
if ($mysqli->connect_errno) {
	// echo "Failed to connect to MySQL: " . $mysqli->connect_error;

	echo '<script>console.info(`line_'.__LINE__.': $mysqli->connect_error`); console.debug('.json_encode($mysqli->connect_error).');</script>'; //! DEBUG
	exit();
}

?>