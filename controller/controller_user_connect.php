<?php 
// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/models/User/User.class.php");


// echo '<pre>';  @var_dump($_REQUEST);  echo '</pre>'; exit('END');    //! DEBUG


// ======================================================================
// VARIABLES 

// creer une fonction pour nettoyer les strings que je recupère en POST ou GET.
// ou est-ce que la fonction existe déjà
$connect_login = htmlentities( $_POST['connect_login'] );
$connect_password = htmlentities( $_POST['connect_login'] ); // TODO : utiliser des regex pour s'assurer qu'il y a des caracteres a-z 0-9 et quelques speciaux.

// ======================================================================
// TRAITEMENT

if (isset($_POST['action']) && $_POST['action'] == 'sendform'){
	// print_r($_POST);

	// importer la classe qui s'occupe des User

	// creer une instance de la classe user
	$user = new User();

	// utiliser une methode `connect($login , $password)` qui va voir dans la database si il y a un user avec ces identifiants.
	// $userExist = $user->loginExist('anthony');

	// si il existe , utiliser une fonction `load()`pour recuperer les infos du user.
	if ($user->loginExist($connect_login)) {
		$user->loadFromLogin($connect_login);
		echo '<h4>Le user a bien été chargé depuis la Database.</h4>';
		echo '<pre>';  @var_dump($user);  echo '</pre>';  exit('END');    //! DEBUG
	}


	// utiliser une fonction qui verifie le password.


	// echo '<pre>';  @var_dump($userExist);  echo '</pre>';  //exit('END');    //! DEBUG

}


// --- check if session from form is the same as the sessionid in client browser.
// ! TEMPORARLY DE-ACTIVATED
/*
if ($_POST['sessionid'] === session_id()){
	$user = new User ();
}
*/


?>