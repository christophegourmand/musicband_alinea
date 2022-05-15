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
		<form id="connect_form" method="POST" action="<?='/controller/controller_user_connect.php'?>" class="form">
			<input type="hidden" name="action" value="sendform">
			<div>
				<label for="connect_login">Identifiant</label>
				<input type="text" name="connect_login" class="form-input" placeholder="identifiant" required>
			</div>
			<div>
				<label for="connect_password">Mot de passe</label>
				<input type="text" name="connect_password" class="form-input" placeholder="Mot de passe" required>
			</div>
			<div>
				<input type="submit" name="submit" value="Se Connecter">
			</div>
		</form>
	</section>
</main>