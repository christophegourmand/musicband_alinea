<?php 
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	# require_once($_SERVER['DOCUMENT_ROOT'].'/chrisdebug.php');
	# session_start();
	// $_SESSION = 
?>

<main>
	<h2 class="page-title">Connexion</h2>
	<?php # dbug('$_SERVER', $_SERVER, 'html_dump') ?>
	<section class="connexion">
		<div class="form-container">
			<form id="connect_form" method="POST" action="<?='/controller/controller_user_connect.php'?>" class="form">
				<input type="hidden" name="action" value="sendform">
				<div class="form-group">
					<label for="connect_login" class="form-label">Identifiant</label>
					<input type="text" id="connect_login" name="connect_login" class="form-input" placeholder="identifiant" required>
				</div>
				<div class="form-group">
					<label for="connect_password" class="form-label">Mot de passe</label>
					<input type="text" name="connect_password" class="form-input" placeholder="Mot de passe" required>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Se Connecter" class="btn btn-outline-white">
				</div>
			</form>
		</div>
	</section>
</main>