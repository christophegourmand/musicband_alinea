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
		<div class="form-container">
			<form id="register_form" method="POST" action="<?='/controller/controller_user_create.php'?>" class="form">
				<input type="hidden" name="sessionid" value="<?= session_id() ?>">
				<div class="form-group">
					<label for="register_login" class="form-label">Identifiant</label>
					<input type="text" name="register_login" id="register_login" class="form-input" placeholder="identifiant" required>
				</div>
				<div class="form-group">
					<label for="register_email" class="form-label">Email</label>
					<input type="text" name="register_email" id="register_email" class="form-input" placeholder="ivain@chevalier-au-lion.fr" required>
				</div>
				<div class="form-group">
					<label for="register_password" class="form-label">Mot de passe</label>
					<input type="text" name="register_password" id="register_password" class="form-input" placeholder="Mot de passe" required>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Créer ce compte" class="btn btn-outline-white">
				</div>
			</form>
		</div>	
	</section>
</main>