<?php

/**
* @param    String   $str    string you need to analyse
* @param    String   $mode   Can be 'letters' , 'digits' , 'letters+digits' , 'letters+digits+dash+underscore' , 'letters+digits+spaces' , 'letters+digits+spaces+apostrophe' , 'password' , 'email'
* for 'email' : letters+digits+dash+underscore+@
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

?>

