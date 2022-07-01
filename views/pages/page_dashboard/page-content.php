<?php 
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/chrisdebug.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

	// require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/User.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Group.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicAlbum.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/MusicSong.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Bio.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Concert.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

	//--- create instance of DbHandler , used to load many rows from database
	$dbHandler = new DbHandler();

	//--- prepare array of menus informations
	$menus_infos = [
		[
			'groupRight_tablename' => 'concert',
			'title_on_hover' => 'Concerts',
			'fontawesome_icon' => '<i class="far fa-calendar-alt"></i>',
		],
		[
			'groupRight_tablename' => 'music_album',
			'title_on_hover' => 'Albums',
			'fontawesome_icon' => '<i class="fas fa-compact-disc"></i>',
		],
		[
			'groupRight_tablename' => 'music_song',
			'title_on_hover' => 'Morceaux',
			'fontawesome_icon' => '<i class="fas fa-music"></i>',
		],
		[
			'groupRight_tablename' => 'bio',
			'title_on_hover' => 'Bios',
			'fontawesome_icon' => '<i class="fas fa-id-card"></i>',
		],
		[
			'groupRight_tablename' => 'product',
			'title_on_hover' => 'Produits',
			'fontawesome_icon' => '<i class="fas fa-tshirt"></i>',
		],
		/* [
			'groupRight_tablename' => 'user',
			'title_on_hover' => '',
			'fontawesome_icon' => '',
		], */
		[
			'groupRight_tablename' => 'photo',
			'title_on_hover' => 'Photos',
			'fontawesome_icon' => '<i class="fas fa-images"></i>',
		],
		[
			'groupRight_tablename' => 'group',
			'title_on_hover' => 'Groupes',
			'fontawesome_icon' => '<i class="fas fa-users"></i>',
		]
		/*
		[
			'groupRight_tablename' => 'asso_group_right', // REVIEW : link to old table-in-database , is it usefull ?
			'title_on_hover' => '',
			'fontawesome_icon' => '<i class="fas fa-users-cog"></i>',
		], 
		*/
		/*
		[
			'groupRight_tablename' => 'partenaire', //REVIEW : no table `partenaire` in database , but rights already in table `group_right`
			'title_on_hover' => 'Partenaires',
			'fontawesome_icon' => '<i class="far fa-handshake"></i>',
		],
		*/
		
	];

	// SECTION : prepare datas , prepare instances of classes
	if ( isset($_SESSION['user_rowid']) && isset($_SESSION['user_login']) && isset($_SESSION['user_fk_group_rowid']) )
	{
		$user = new User();
		$user->load($mysqli, $_SESSION['user_rowid']);

		$user_group = $user->get_group();
		$GLOBALS['user_group_rights'] = $user_group->get_rightsForAllTables($mysqli);
		# var_dump( $user_group_rights ); // DEBUG

		// ######################################################################
		// SECTION : after a menu on aside-bar was clicked :
		// ######################################################################
		if (isset($_GET['clicked_menu']) && $_GET['clicked_menu'] !== null && $_GET['clicked_menu'] !== '')
		{
			require_once(__DIR__."/prepareDatasPerTable/_prepareDatas_".$_GET['clicked_menu'].".php");
		}
	}
?>

<main class="adminpage">
	<aside class="adminpage-aside">
		<ul class="adminpage-menus">
			<?php foreach ($menus_infos as $menu_infos) :?>
				<?php if ($GLOBALS['user_group_rights'][ $menu_infos['groupRight_tablename'] ]['can_see'] === true): ?>
					<li class="adminpage-menu">
						<a 
							title="<?= $menu_infos['title_on_hover']?>" 
							href="<?= $_SERVER['PHP_SELF'].'?clicked_menu='.$menu_infos['groupRight_tablename'] ?>" 
							class="adminpage-menu-link"
						>
							<?= $menu_infos['fontawesome_icon']?>
						</a>
					</li>
				<?php endif?>
			<?php endforeach ?>

			<?php //--- here I don't use the array $menus_infos as user require special conditions ?>
			<?php if ($GLOBALS['user_group_rights']['user.webadmin']['can_see'] === true || $GLOBALS['user_group_rights']['user.band_musicians']['can_see'] === true || $GLOBALS['user_group_rights']['user.band_staff']['can_see'] === true || $GLOBALS['user_group_rights']['user.fan']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<a 
						title="Users"
						href="<?= $_SERVER['PHP_SELF'].'?menu=user' ?>"
						class="adminpage-menu-link"
					>
						<i class="fas fa-user-friends"></i>
					</a>

					<!-- NOTE : other possibles icones -->
					<!-- <a href="" class="adminpage-menu-link">Utilisateurs</a> -->
					<!-- <a title="Utilisateurs" href="" class="adminpage-menu-link"><i class="fas fa-id-card"></i></a> -->
				</li>
			<?php endif?>
		</ul>
	</aside>
	
	<!-- ############################### -->
	<div class="dashboard">
		<h2 class="page-title">Tableau de bord</h2>
		<?php 
			// --- html who display the message if there is a key in $_GET or $_COOKIE :
			include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php");
		?>
		<section class="dashboard-section">
			<?php 
				// ######################################################################
				// SECTION : after a menu on aside-bar was clicked :
				// ######################################################################
				if (isset($_GET['clicked_menu']) && $_GET['clicked_menu'] !== null && $_GET['clicked_menu'] !== '')
				{
					require_once(__DIR__."/dashboardViewPerTable/_dashboardView_".$_GET['clicked_menu'].".php");
				}
			?>
		</section>
	</div>
</main>