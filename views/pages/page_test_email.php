<?php
require_once($_SERVER['DOCUMENT_ROOT']."/.env.php");

require_once "Mail.php";

$$ex2_mail_from = "myaccount@gmail.com";
$to = 'test@mytest.com';

$host = "ssl://smtp.gmail.com";
$port = "465";
$username = 'myaccount@gmail.com';
$password = 'mypassword';

$subject = "EX2 - Aline-musique.fr - test d'envoi Email";
$body = "test";

$headers = array(
	'From' => $ex2_mail_from, 
	'To' => $ex2_mail_to, 
	'Subject' => $subject
);

$smtp = Mail::factory(
	'smtp',
	array(
		'host' => $ex2_mail_host,
		'port' => $ex2_mail_port_smtp,
		'auth' => true,
		'username' => $ex2_mail_username,
		'password' => $ex2_mail_password
	)
);

$mail = $smtp->send($ex2_mail_to, $headers, $body);

if (PEAR::isError($mail)) {
	echo ($mail->getMessage());
} else {
	echo ("Message successfully sent!\n");
}
