<?php 
	# require_once($_SERVER['DOCUMENT_ROOT'].'/chrisdebug.php');
	# session_start();
	// $_SESSION = 

	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");

	$otherActionValue = 'noaction';
	$action = $_POST['action'] ?? $otherActionValue;

	if ($action == 'noaction')
	{
		$given_login = '';
	}

	if ($action == 'login_sent')
	{
		$given_login = $_POST['given_login'] ?? ''; 

		$connecting_user = new User();

		// require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
		$loginExist = $connecting_user->loginExist($mysqli , $given_login);
	}
?>

<main>
	<h2 class="page-title">Connexion</h2>
	<?php
		if (isset($_GET['messageKey']) || isset($_COOKIE['messageKey']))
		{
			if (isset($_GET['messageKey']))
			{
				$messageKey = $_GET['messageKey'];
			} elseif (isset($_COOKIE['messageKey']))
			{
				$messageKey = $_COOKIE['messageKey'];
			}
			$popupMessage_arr = getMessageFromKey($messageKey);
			// --- file containing html who display the message :
			include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php");
		}
	?>
	<!-- SECTION : form for login -->
	<?php if($action == 'noaction'): ?>
		<section class="connexion">
			<div class="form-container">
				<form id="connect_form_login" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" class="form">
					<input type="hidden" name="action" value="login_sent">
					<div class="form-group">
						<label for="given_login" class="form-label">Identifiant</label>
						<input type="text" id="given_login" name="given_login" class="form-input" placeholder="identifiant" value="<?= $given_login ?>" required>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Valider" class="btn btn-outline-white">
					</div>
				</form>
			</div>
		</section>
	<?php endif ?>

	<!-- SECTION : form for password -->
	<?php if($action == 'login_sent' && $loginExist): ?>
		<section class="connexion">
			<div class="form-container">
				<form id="given_form_password" method="POST" action="<?= '/controller/controller_user_connect.php'?>" class="form">
					<input type="hidden" name="action" value="check_credentials">
					<input type="hidden" name="given_login" value="<?= $given_login ?>">

					<div class="form-group">
						<label for="given_login" class="form-label">Identifiant</label>
						<input type="text" id="given_login" name="given_login" class="form-input" placeholder="identifiant" value="<?= $given_login ?>" disabled>
					</div>
					
					<div class="form-group">
						<label for="given_password" class="form-label">Mot de passe</label>
						<input type="password" name="given_password" class="form-input" placeholder="Mot de passe" required autofocus>
					</div>

					<div class="form-group">
						<input type="submit" name="submit" value="Se Connecter" class="btn btn-outline-white">
					</div>
				</form>
			</div>
		</section>
	<?php endif ?>

</main>