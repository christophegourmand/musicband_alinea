<?php

/**
* @param    String   $str    string you need to analyse
* @param    String   $mode   Can be 'letters' , 'digits' , 'letters+digits' , 'letters+digits+dash+underscore' , 'letters+digits+spaces' , 'letters+digits+spaces+apostrophe' , 'password' , 'email'
* for 'email' : letters+digits+dash+underscore+@
* @deprecated
* @return bool
*/
function containOnlyAuthorizedCharacters(string $str, string $mode="") : bool
{
	$containBadCharacters = false;

	switch ($mode) {
		case 'letters':
			//--- contain other than a-z letters ?
			$containBadCharacters = preg_match("/[^a-z]/i", $str) ? true : false;
			/*	/i pour case insensitive , 
				/g pour trouver tous les characters, pas sa'arrêters au 1er ,
				^ pour dire "autre caractère que a-z ,
			*/
			break;
		case 'digits':
			$containBadCharacters = preg_match("/[\D]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
			*/
			break;
		case 'letters+digits':
			$containBadCharacters = preg_match("/[^a-z0-9]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
			*/
			break;
		case 'letters+digits+dash+underscore':
			$containBadCharacters = preg_match("/[^a-z0-9\_\-]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
			*/
			break;
		case 'letters+digits+spaces':
			//---v1 (utiliser en priorité)
			$containBadCharacters = preg_match("/[^a-z0-9 ]/i", $str) ? true : false;
			/* l'espace après le 9 est pour autoriser les espaces */
			//---v2 (utiliser si v1 fonctionne mal)
			# $containBadCharacters = preg_match("/[\W]/igx", $str) ? true : false;
			/* le x pour ignorer les espaces dans la recherche */
			break;
		case 'letters+digits+spaces+apostrophe+quote+dash+underscore':
			$containBadCharacters = preg_match("/[^a-z0-9 \'\_\-\"]/i", $str) ? true : false;
			break;
		case 'letters+digits+spaces+apostrophe':
			$containBadCharacters = preg_match("/[^a-z0-9 \']/i", $str) ? true : false;
			break;
		case 'password':
			// TODO : À TESTER ( utilisé dans classe User->set_pass()  )
			$containBadCharacters = preg_match("/[^a-z0-9\_\-\@\!\.\?\&\*\$\,\;\:\+\=]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
			*/
			break;
		case 'email':
			// --- letters+digits+dash+underscore+@
			$containBadCharacters = preg_match("/[^a-z0-9\_\-\.\@]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
				\_ pour underscore
				\@ pour arobase 
				etc
			*/
			break;

		default:
			throw new Exception("ERREUR : le mode passé en 2e param est inconnu");
			break;
	}

	$containOnlyAuthorizedCharacters = !$containBadCharacters;

	return $containOnlyAuthorizedCharacters;
}


/**
* @param	string		$date	Full date as string in english.(ex: Thursday 16 June 2022)
* @return string	Return the same string as $date, bt with Days and months translated.
*/
function translateDaysAndMonths (string $date_english_str) : string
{
	$english_days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

	$french_days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

	$english_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

	$french_months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

	$date_french_str = str_replace($english_days , $french_days , $date_english_str);
	$date_french_str = str_replace($english_months , $french_months , $date_french_str);
	# $date_french_str = str_replace(' - ' , ' à ' , $date_french_str);

	return $date_french_str;
}


/**
 * getMessageFromKey
 *
 * @param  string 	$messageKey
 * @return mixed
 */
function getMessageFromKey(string $messageKey)
{
	//--- table initialisation
	$translationTable = [];

	//--- key
	$translationTable['userAlreadyExist'] = 
		[
			'cssclass' => 'warning',
			'text' => "Désolé mais impossible de créer un compte avec cet identifiant car il existe déjà !"
		
		];
	
	//--- key
	$linkToConnectPage = "/views/pages/page_connexion.php";
	$translationTable['userCreatedSuccessfully'] = 
		[
			'cssclass' => 'success',
			'text' => "Le compte utilisateur a bien été créé !<br><br><a href='$linkToConnectPage' class='btn btn-outline-white'>Se Connecter</a>" 
		];

	//--- key
	$translationTable['youAreConnected'] = 
		[
			'cssclass' => 'success',
			'text' => "Vous êtes connecté !",
		];

	//--- key
	$translationTable['youAreDisconnected'] = 
		[
			'cssclass' => 'success',
			'text' => "Vous êtes bien déconnecté !<br><br>N'hésitez pas à repasser sur le site pour voir les dates de concerts, photos, et actus.<br>À bientôt !",
		];

	//--- key
	$translationTable['yourPasswordIsWrong'] = 
		[
			'cssclass' => 'error',
			'text' => "You shall not pass !<br>Le mot de passe que vous venez d'entrer ne correspond pas à celui que vous nous aviez donné." 
		];

	//--- key
	$translationTable['formContactWorksSoon'] = 
		[
			'cssclass' => 'info',
			'text' => "Ce formulaire sera bientôt opérationnel, en attendant veuillez nous contacter par l'adresse suivante:<br><a style=\"color: #ffffff; text-decoration:underline;\" href=\"mailto:alineamusique@gmail.com\">alineamusique@gmail.com</a>"
		];

	//--- key
	$translationTable['formControllerReceivedWrongParameters'] = 
		[
			'cssclass' => 'error',
			'text' => "Le controlleur en charge de valider le formulaire n'a pas reçu les bons paramètres. Particulièrement l'action et la classe de l'entité."
		];

	//--- key
	$translationTable['$entityCanNotBeDeleted'] = 
		[
			'cssclass' => 'error',
			'text' => "Cet enregistrement n'a pas pu étre supprimé de la base de données ! Contactez-le developpeur du site pour en chercher la cause. <em>(en bas de page, aller dans 'Partenaires' pour le contacter)</em>." 
		];

	//--- key
	$translationTable['$entityHasBeenDeletedWell'] = 
		[
			'cssclass' => 'success',
			'text' => "Cet enregistrement a bien été supprimé de la base de données !" 
		];

	if (in_array($messageKey, array_keys($translationTable) ))
	{
		return $translationTable[$messageKey];
	} else {
		return null;
	}
}

function getMessageFromCustomMessage(string $customMessage, string $cssclass)
{
	$popupMessage_arr = [
		'cssclass' => $cssclass,
		'text' => $customMessage 
	];

	return $popupMessage_arr;
}


/**
* Will redirect to page_message.php and pass in url
* a `customMessage` and a `cssclass` so the page 
* display the message
* @param	string	$customMessage	:the text message who will be passed 
* as in url with urlencode.
* @param	string	$cssclass	:can be 'error' , 'info' or 'success'
* @see functions/utility_functions.php >> getMessageFromKey()
* @return void
*/
function redirectOnPageMessageWithCustomMessage(string $customMessage, string $cssclass)
{
	header('Location: '.'/views/pages/page_message.php?customMessage='.urlencode($customMessage).'&cssclass='.$cssclass);
	exit();
}

/**
* Will redirect to page_message.php and pass a `messageKey` in url.
* the code in page_message.php will use the key to 
* get the corresponding message and css class, and display it.
* @param	string	$messageKey		all keys are listed in functions/utility_functions.php >> getMessageFromKey()
* @see functions/utility_functions.php >> getMessageFromKey()
* @return void
*/
function redirectOnPageMessageWithMessageKey(string $messageKey)
{
	header('Location: '.'/views/pages/page_message.php?messageKey='.$messageKey);
	exit();
}


?>

