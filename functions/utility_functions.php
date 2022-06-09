<?php

/**
* @var    String   $str    string you need to analyse
* @var    String   $mode   Can be 'letters' , 'digits' , 'letters+digits' , 'letters+digits+dash+underscore' , 'letters+digits+spaces' , 'letters+digits+spaces+apostrophe' , 'password' , 'email'
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
		case 'email':
			// --- letters+digits+dash+underscore+@
			$containBadCharacters = preg_match("/[^a-z0-9\_\-\.\@]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
				\_ pour underscore
				\@ pour arobase 
				etc
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
		case 'letters+digits+spaces+apostrophe':
			$containBadCharacters = preg_match("/[^a-z0-9 \']/i", $str) ? true : false;
			break;
		case 'password':
			// TODO : À TESTER ( utilisé dans classe User->set_pass()  )
			$containBadCharacters = preg_match("/[^a-z0-9\_\-\@\!\.\?\&\*\$\,\;\:\+\=]/i", $str) ? true : false;
			/*	\D  pour any non-digit character
			*/
			break;

		default:
			throw new Exception("ERREUR : le mode passé en 2e param est inconnu");
			break;
	}

	$containOnlyAuthorizedCharacters = !$containBadCharacters;

	return $containOnlyAuthorizedCharacters;
}

?>

