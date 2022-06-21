<footer>
	<nav class="navfooter">
		<ul class="navfooter-menus">
			<li class="navfooter-item">
				<a class="navfooter-link" href="<?php echo('/views/pages/page_sitemap.php');?>">Plan du site</a>
			</li>
			<li class="navfooter-item">
				<a class="navfooter-link" href="<?php echo('/views/pages/page_contact.php');?>" target="_top">Contacter le groupe</a>
			</li>
			<li class="navfooter-item">
				<a class="navfooter-link" href="<?php echo('/views/pages/page_partenaires.php');?>" target="_top">Partenaires</a>
			</li>
			<li class="navfooter-item">
				<a class="navfooter-link" href="mailto:christophe.gourmand@gmail.com" target="_top">Contacter le Webmaster</a>
			</li>
			<li class="navfooter-item">
				<a class="navfooter-link" href="<?php echo('/views/pages/page_apropos.php');?>" target="_top">À propos</a>
			</li>
			<!-- 
			<li class="navfooter-item">
				<a class="navfooter-link" href="<?php echo('/views/pages/page_metronome.php');?>" target="_top">Metronome v1</a>
			</li>
			-->
			<li class="navfooter-item">
				<a class="navfooter-link" href="<?php echo('/views/pages/page_metronome2.php');?>" target="_top">Metronome 2.0</a>
			</li>
		</ul>

		<?php if ($env === 'dev'): ?>
			<h4 style="text-align: center; background-color: red; color: white;">Menus affichés en mode 'dev' uniquement :</h4>
			<ul class="navfooter-menus" style="background-color: red;">
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_debug.php');?>" target="_top">page_debug</a>
				</li>
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_db_test.php');?>" target="_top">page_db_test</a>
				</li>
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_register.php');?>" target="_top">page_register</a>
				</li>
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_connexion.php');?>" target="_top">page_connexion</a>
				</li>
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_message.php');?>" target="_top">page_message</a>
				</li>
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_partenaires.php');?>" target="_top">page_partenaires</a>
				</li>
				<li class="navfooter-item">
					<a class="navfooter-link" href="<?php echo('/views/pages/page_acheter.php');?>" target="_top">page_acheter</a>
				</li>
			</ul>
		<?php endif ?>

	</nav>
</footer>