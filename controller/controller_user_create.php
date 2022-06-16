<?php 
// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");


require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

// ======================================================================
// VARIABLES 

// NOTE : we should have : 'register_login' , 'register_email' , 'register_password'
// echo '<pre>';  @var_dump($_REQUEST);  echo '</pre>'; exit('END');    //! DEBUG

// creer une fonction pour nettoyer les strings que je recupère en POST ou GET.
// ou est-ce que la fonction existe déjà
$register_login = htmlentities( $_POST['register_login'] );
$register_email = htmlentities( $_POST['register_email'] );
$register_password = htmlentities( $_POST['register_password'] );

// ======================================================================
// TRAITEMENT

// creer une instance de la classe user
$registering_user = new User();

// SECTION: verification: if user exist, we display a message page saying that login exist.
$loginAlreadyExist = $registering_user->loginExist($mysqli , $register_login);

if ($loginAlreadyExist)
{
	//--- close connection before re-routing to another page
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

	$messagekey = "userAlreadyExist";
	header('Location: '.'/views/pages/page_message.php?messagekey='.$messagekey);
	exit();
}

// SECTION: create user in database

$registering_user->set_active(1);
$registering_user->set_login($register_login);
$registering_user->set_pass($register_password);
//--- encode password
$registering_user->set_pass_encoded( password_hash($register_password, PASSWORD_DEFAULT) );

$registering_user->set_fk_group_rowid(4);
$registering_user->set_email($register_email);
$registering_user->create($mysqli);


//--- close connection before re-routing to another page
require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

$messagekey = "userCreatedSuccessfully";
header('Location: '.'/views/pages/page_message.php?messagekey='.$messagekey);
exit();
// - - - - - - -  

require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

?>