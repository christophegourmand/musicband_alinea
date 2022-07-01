			<?php if ($GLOBALS['user_group_rights']['concert']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Concerts</a> -->
					<?php $menu='concert' ?>
					<a title="Concerts" href="<?= $_SERVER['PHP_SELF'].'?menu='.$menu ?>" class="adminpage-menu-link"><i class="far fa-calendar-alt"></i></a>
				</li>
			<?php endif?>

			<?php if ($GLOBALS['user_group_rights']['music_album']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Albums</a> -->
					<?php $menu='music_album' ?>
					<a title="Albums" href="<?= $_SERVER['PHP_SELF'].'?menu='.$menu ?>" class="adminpage-menu-link"><i class="fas fa-compact-disc"></i></a>
				</li>
			<?php endif?>

			<?php if ($GLOBALS['user_group_rights']['music_song']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Morceaux</a> -->
					<a title="Morceaux" href="" class="adminpage-menu-link"><i class="fas fa-music"></i></a>
				</li>
			<?php endif?>
			<?php if ($GLOBALS['user_group_rights']['bio']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Bios</a> -->
					<!-- <a href="" class="adminpage-menu-link"><i class="fas fa-user-astronaut"></i></a> -->
					<a title="Bios" href="" class="adminpage-menu-link"><i class="fas fa-id-card"></i></a>
				</li>
			<?php endif?>

			<?php if ($GLOBALS['user_group_rights']['product']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Produits</a> -->
					<a title="Produits" href="" class="adminpage-menu-link"><i class="fas fa-tshirt"></i></a>
				</li>
			<?php endif?>

			<!-- TODO : ici faire aussi product image (mais choisir une icone avant) -->
				
			
				
			<?php if ($GLOBALS['user_group_rights']['group']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Groupes</a> -->
					<a title="Groupes" href="" class="adminpage-menu-link"><i class="fas fa-users"></i></a>
				</li>
			<?php endif?>
				
			<!-- REVIEW : link to old table-in-database , is it usefull ? -->
			<?php # if ($GLOBALS['user_group_rights']['asso_group_right']['can_see'] === true): ?>
				<!-- <li class="adminpage-menu"> -->
					<!-- <a href="" class="adminpage-menu-link">Droits</a> -->
					<!-- <a title="Droits" title="Albums" href="" class="adminpage-menu-link"><i class="fas fa-users-cog"></i></a> -->
				<!-- </li> -->
			<?php # endif?>

			<!--  -->
			<?php # if ($GLOBALS['user_group_rights']['partenaire']['can_see'] === true): ?>
				<!-- <li class="adminpage-menu"> -->
					<!-- <a href="" class="adminpage-menu-link">Partenaires*</a> -->
					<!-- <a title="Partenaires" href="" class="adminpage-menu-link"><i class="far fa-handshake"></i></a> -->
				<!-- </li> -->
			<?php # endif?>
				
			<?php if ($GLOBALS['user_group_rights']['photo']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<a title="Photos" href="" class="adminpage-menu-link"><i class="fas fa-images"></i></a>
				</li>
			<?php endif?>