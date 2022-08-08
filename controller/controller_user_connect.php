<?php 
//--- generate or get the session id.
session_start();

// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");


// ======================================================================
// VARIABLES 

// NOTE : we should have : 'given_login' , 'given_password'

$given_login = htmlentities( $_POST['given_login'] );
$given_password = htmlentities( $_POST['given_password'] );

// ======================================================================
// TRAITEMENT

if (isset($_POST['action']) && $_POST['action'] == 'check_credentials')
{
	// creer une instance de la classe user
	$user = new User();

	if ($user->loginExist($mysqli , $given_login)) 
	{
		$user->loadFromLogin($mysqli , $given_login);

		if ($user->passwordCorrespondToHash($given_password))
		{
			$_SESSION['user_login'] = $user->get_login();
			$_SESSION['user_rowid'] = $user->get_rowid();
			$_SESSION['user_fk_group_rowid'] = $user->get_fk_group_rowid();

			redirectOnPageMessageWithMessageKey("youAreConnected");
		}
		else 
		{
			//--- redirect to page_connexion (which we come from)
			$messageKey = "yourPasswordIsWrong";
			header('Location: '.$_SERVER['HTTP_REFERER'].'?messageKey='.$messageKey);
			exit();
		}
	}
}

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

// --- check if session from form is the same as the sessionid in client browser.
// ! TEMPORARLY DE-ACTIVATED
/*
if ($_POST['sessionid'] === session_id()){
	$user = new User ();
}
*/


?>