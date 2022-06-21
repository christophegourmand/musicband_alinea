<?php 
// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

// ======================================================================
// VARIABLES 

// NOTE : we should have : 'given_login' , 'given_password'

echo '<pre>';  @var_dump($_REQUEST);  echo '</pre>'; // exit('END');    // DEBUG

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
			$messagekey = "youAreConnected";
			header('Location: '.'/views/pages/page_message.php?messagekey='.$messagekey);
			exit();
		}
		else 
		{
			$messagekey = "yourPasswordIsWrong";
			header('Location: '.'/views/pages/page_message.php?messagekey='.$messagekey);
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