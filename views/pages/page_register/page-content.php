<?php 
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/chrisdebug.php');

	// $newToken = ;
	// $_SESSION = 
?>

<main>
	<h2 class="page-title">Création de compte</h2>
	<?php # dbug('$_SERVER', $_SERVER, 'html_dump') ?>
	<section class="connexion">
		<form id="register_form" method="POST" action="<?='/controller/controller_user_create.php'?>" class="form">
			<input type="hidden" name="sessionid" value="<?= session_id() ?>">
			<div>
				<label for="register_login">Identifiant</label>
				<input type="text" name="register_login" id="register_login" class="form-input" placeholder="identifiant" required>
			</div>
			<div>
				<label for="register_email">Email <small><em>(sera encrypté dans la base de données.)</em></small></label>
				<input type="text" name="register_email" id="register_email" class="form-input" placeholder="ivain@chevalieraulion.fr" required>
			</div>
			<div>
				<label for="register_password">Mot de passe</label>
				<input type="text" name="register_password" id="register_password" class="form-input" placeholder="Mot de passe" required>
			</div>
			<div>
				<input type="submit" name="submit" value="Créer un compte">
			</div>
		</form>
	</section>
</main>