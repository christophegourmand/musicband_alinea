<?php
require_once($_SERVER['DOCUMENT_ROOT']."/.env.php");

$mysqli = new mysqli($db_serveur, $db_username, $db_userpass, $db_name);

?>