<?php 
//--- generate or get the session id.
session_start();

// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

// ======================================================================
// VARIABLES 



// ======================================================================
// TRAITEMENT

if ( isset($_SESSION['user_rowid']) && isset($_SESSION['user_login']) && isset($_SESSION['user_fk_group_rowid']) )
{
	session_unset();
	session_destroy();

	$messageKey = "youAreDisconnected";
	header('Location: '.'/views/pages/page_message.php?messageKey='.$messageKey);
}


require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");


?>