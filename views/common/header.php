<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/.env.php");
	include($_SERVER['DOCUMENT_ROOT']."/"."common_variables.php");
?>

<header>
	<div class="header-head">
		<div class="brand">
			<!-- <img class="brand-logo" src="/assets/img/icons/Logo_Alinea_red_big.png" alt="logo ALINEA" title="logo ALINEA"> -->
			<img class="brand-logo" src="/assets/img/icons/Logo_Alinea_red_big.png" alt="logo ALINEA" title="logo ALINEA">
			<!--  BACKUP :
			<a href="www.google.fr">
				<h1 class="brand-name">ALINEA</h1>
			</a>
			-->
			<h1 class="brand-name"><a href="/">ALINÉA.</a></h1>

		</div>

		<div class="usermenu">
			<?php if ( isset($_SESSION['user_rowid']) && isset($_SESSION['user_login']) && isset($_SESSION['user_fk_group_rowid']) ) :?>
				<div class="usermenu-icon connected" id="usermenu_icon">
					<!-- <i class="fas fa-user"></i> -->
					<i class="fas fa-user-circle"></i>
				</div>
				<p class="usermenu-login"><?= $_SESSION['user_login'] ?></p>
				<div class="usermenu-menus hide" id="usermenu_menus">
					<ul class="usermenu-menus-list">
						<li class="usermenu-menus-element">
							<a href="#" class="usermenu-menus-link">aaa</a>
						</li>
						<li class="usermenu-menus-element">
							<a href="#" class="usermenu-menus-link">bbb</a>
						</li>
						<li class="usermenu-menus-element">
							<a href="#" class="usermenu-menus-link">ccc</a>
						</li>
					</ul>
				</div>
			<?php else : ?>
				<div class="usermenu-icon disconnected">
					<!-- <i class="far fa-user"></i> -->
					<i class="far fa-user-circle"></i>
				</div>
				<a class="usermenu-signin-link" href="/views/pages/page_connexion.php">Se Connecter</a>
			<?php endif ?>
		</div>

		<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/modules/navbar.php"); ?>
	
	</div>

	<!-- <p class="incrustation_pixels" id="incrustation_pixels">000 px<p> -->

</header>