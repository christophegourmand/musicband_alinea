<?php
require_once($_SERVER['DOCUMENT_ROOT']."/.env.php");

if (!isset($mysqli) || empty($mysqli)){
	$mysqli = new mysqli($db_serveur, $db_username, $db_userpass, $db_name);
}

?>