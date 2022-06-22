<!-- TODO : ci dessous remettre la classe 'hide' par defaut -->
<div class="usermenu-menus hide" id="usermenu_menus">
	<ul class="usermenu-menus-list">
		<?php if ( isset($_SESSION['user_rowid']) && isset($_SESSION['user_login']) && isset($_SESSION['user_fk_group_rowid']) ) :?>

			<li class="usermenu-menus-element">
				<a href="#" class="usermenu-menus-link">Mon compte <small>(en prépa)</small></a>
			</li>
			<li class="usermenu-menus-element">
				<a href="#" class="usermenu-menus-link">Tableau de bord</a>
			</li>
			<li class="usermenu-menus-element">
				<a href="#" class="usermenu-menus-link">Messages au groupe <small>(en prépa)</small></a>
			</li>
			<li class="usermenu-menus-element">
				<a href="<?= '/controller/controller_user_disconnect.php' ?>" class="usermenu-menus-link">Se déconnecter</a>
			</li>

		<?php else: ?>
			<li class="usermenu-menus-element">
				<a href="/views/pages/page_connexion.php" class="usermenu-menus-link">Se Connecter</a>
			</li>
			<br>
			<li class="usermenu-menus-element">
				<a href="/views/pages/page_register.php" class="usermenu-menus-link">Créer un compte</a>
			</li>
			<br>
			<li class="usermenu-menus-element">
				<a href="#" class="usermenu-menus-link">En savoir plus <small>(en prépa)</small></a>
			</li>
		<?php endif ?>
	</ul>
</div>
