<?php
// ======================================================================
// IMPORTS

require_once($_SERVER['DOCUMENT_ROOT']."/.env.php");

// NOTE: activate if necessary
# require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");

$formFullyFilled = true;
$formFullyFilled &= !empty($_POST['formContact_senderMail']);
$formFullyFilled &= !empty($_POST['formContact_senderName']);
$formFullyFilled &= !empty($_POST['formContact_message']);

if ($formFullyFilled)
{
	// TODO : utiliser la fonction `htmlentities()`
	// LINK : https://www.php.net/manual/en/function.htmlentities.php

	//--- Prepare fields for the email to be sent
		$senderEmailAddress = (string) $_POST['formContact_senderMail'];
		$senderName = (string) $_POST['formContact_senderName'];
		
		// REVIEW , change addresse according to situation
		$receiver = "christophe.gourmand@gmail.com";// for dev
		# $receiver = "alineamusique@gmail.com"; // for prod

		$subject = "CONTACT - Message de ".$senderName;

		$messageFromForm = (string) $_POST['formContact_message'];
		
		# $messageFromFormWithLineBreaks = str_replace("\r\n")
		$recapMessage = <<<MESSAGE
			<!DOCTYPE html>
				<html lang="fr">
					<head>
						<meta charset="UTF-8">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
						<title>Email</title>
					</head>
					<body>
						<h1>Site Alinea-musique.fr</h1>
						<h2>Message depuis la page Contact</h2>
						<hr>
						<p><strong>Nom:</strong></p>
						<p></p>
						<p><strong>Email:</strong></p>
						<p></p>
						<p><strong>Message:</strong></p>
						<p>$messageFromForm</p>
					</body>
				</html>
			</html>
		MESSAGE;

	//--- prepare header of the email !! FOR PHP BEFORE 7.2 !!
		/*
		$additionnalHeaders = [];
		# $additionnalHeaders[] = 'From: sitealineamusique@gmail.com'; // au choix
		$additionnalHeaders[] = 'From: '.$senderEmailAddress; // au choix
		$additionnalHeaders[] = 'Reply-To: '.$senderEmailAddress;
		$additionnalHeaders[] = 'X-Mailer: PHP/'.phpversion();
		$headersAsOneString = implode('\r\n', $headers);
		
		mail($receiver , $subject, $messageFromForm , $headersAsOneString);
		*/

	//--- prepare header of the email !! FOR PHP BEFORE 7.2 !!
		$additionnalHeaders = [
			'MIME-Version' => '1.0'
			, 'Content-type' => 'text/html; charset=utf8'
			, 'From' => $ex2_mail_from
			# 'From' => 'sitealineamusique@gmail.com' //--- choose if better
			, 'Reply-To' => $senderEmailAddress
			, 'X-Mailer' => 'PHP/'.phpversion()
		];

		// NOTE : éteint temporairement
		$emailWasSent = mail($receiver , $subject, $recapMessage , $additionnalHeaders);

		// NOTE : essai d'envoi simple
		/*
		$headers = [
			'From' => 'contact@alinea-musique.fr',
			'Reply-To' => 'contact@alinea-musique.fr',
			'X-Mailer' => 'PHP/'.phpversion()
		];
		$emailWasSent = mail("contact@alinea-musique.fr", "Objet: ESSAI d'envoi", "Corps : Essai d'envoi d'email.");
		*/

		if ($emailWasSent)
		{
			// TODO : rediriger vers une page qui dit que le message a été envoyé
			print "<h3>le message a bien été envoyé !</h3>";
		} else 
		{
			// TODO : rediriger vers une page qui dit que le message n'a pas été envoyé
			print "<h3>le message n'a pas été envoyé suite à un problème.</h3>";
		}
}

// NOTE: activate if necessary
# require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");
?>