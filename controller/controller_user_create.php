<?php 
// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");


require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

// ======================================================================
// VARIABLES 

// NOTE : we should have : 'given_login' , 'given_email' , 'given_password'

$given_login = htmlentities( $_POST['given_login'] );
$given_email = htmlentities( $_POST['given_email'] );
$given_password = htmlentities( $_POST['given_password'] );

// ======================================================================
// TRAITEMENT

// creer une instance de la classe user
$registering_user = new User();

// SECTION: verification: if user exist, we display a message page saying that login exist.
$loginAlreadyExist = $registering_user->loginExist($mysqli , $given_login);

if ($loginAlreadyExist)
{
	//--- close connection before re-routing to another page
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

	$messageKey = "userAlreadyExist";
	header('Location: '.'/views/pages/page_message.php?messageKey='.$messageKey);
	exit();
}

// SECTION: create user in database

$registering_user->set_active(1);
$registering_user->set_login($given_login);
$registering_user->set_pass($given_password);
//--- encode password
$registering_user->set_pass_encoded( password_hash($given_password, PASSWORD_DEFAULT) );

$registering_user->set_fk_group_rowid(4);
$registering_user->set_email($given_email);
$registering_user->create($mysqli);


//--- close connection before re-routing to another page
require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

$messageKey = "userCreatedSuccessfully";
header('Location: '.'/views/pages/page_message.php?messageKey='.$messageKey);
exit();
// - - - - - - -  

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

?>