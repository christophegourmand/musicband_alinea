<div class="form-container">
	<form id="register_form" method="POST" action="<?='/controller/controller_user_create.php'?>" class="form">
		<input type="hidden" name="sessionid" value="<?= session_id() ?>">
		<div class="form-group">
			<label for="given_login" class="form-label">Identifiant</label>
			<input type="text" name="given_login" id="given_login" class="form-input" placeholder="identifiant" required>
		</div>
		<div class="form-group">
			<label for="given_email" class="form-label">Email</label>
			<input type="text" name="given_email" id="given_email" class="form-input" placeholder="ivain@chevalier-au-lion.fr" required>
		</div>
		<div class="form-group">
			<label for="given_password" class="form-label">Mot de passe</label>
			<input type="password" name="given_password" id="given_password" class="form-input" placeholder="Mot de passe" required>
		</div>
		<div class="form-group">
			<input type="submit" name="submit" value="Créer ce compte" class="btn btn-outline-white">
		</div>
	</form>
</div>	