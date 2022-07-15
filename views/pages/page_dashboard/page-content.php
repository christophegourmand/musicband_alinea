<?php 

	// SECTION - imports
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

	// SECTION - variables from $_GET and $_POST
	$action = $_GET['action'] ?? '';
	$rowid_from_get = $_GET['rowid'] ?? -1;
	$entity = $_GET['entity'] ?? ''; // --- `$entity` is the name of the clicked menu ('concert' , 'user', etc)


	//--- create instance of DbHandler , used to load many rows from database
	$dbHandler = new DbHandler();

	//--- prepare array of menus informations
	$entities_infos = [
		[
			'tablename' => 'concert',
			'classname' => 'Concert',
			'title_on_hover' => 'Concerts',
			'fontawesome_icon' => '<i class="far fa-calendar-alt"></i>',
		],
		[
			'tablename' => 'music_album',
			'classname' => 'MusicAlbum',
			'title_on_hover' => 'Albums',
			'fontawesome_icon' => '<i class="fas fa-compact-disc"></i>',
		],
		[
			'tablename' => 'music_song',
			'classname' => 'MusicSong',
			'title_on_hover' => 'Morceaux',
			'fontawesome_icon' => '<i class="fas fa-music"></i>',
		],
		[
			'tablename' => 'bio',
			'classname' => 'Bio',
			'title_on_hover' => 'Bios',
			'fontawesome_icon' => '<i class="fas fa-id-card"></i>',
		],
		[
			'tablename' => 'product',
			'classname' => null,
			'title_on_hover' => 'Produits',
			'fontawesome_icon' => '<i class="fas fa-tshirt"></i>',
		],
		/* [
			'tablename' => 'user',
			'classname' => 'User',
			'title_on_hover' => '',
			'fontawesome_icon' => '',
		], */
		/* [
			'tablename' => 'photo',
			'classname' => '',
			'title_on_hover' => 'Photos',
			'fontawesome_icon' => '<i class="fas fa-images"></i>',
		], */
		[
			'tablename' => 'group',
			'classname' => 'Group',
			'title_on_hover' => 'Groupes',
			'fontawesome_icon' => '<i class="fas fa-users"></i>',
		]
		/*
		[
			'tablename' => 'asso_group_right', // REVIEW : link to old table-in-database , is it usefull ?
			'classname' => null,
			'title_on_hover' => '',
			'fontawesome_icon' => '<i class="fas fa-users-cog"></i>',
		], 
		*/
		/*
		[
			'tablename' => 'partenaire', //REVIEW : no table `partenaire` in database , but rights already in table `group_right`
			'classname' => null,
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

		// ######################################################################
		// SECTION : after a menu on aside-bar was clicked :
		// ######################################################################
		if ($entity !== '' /* && $action === 'showDashboardOfEntity' */) // --- `$entity` (from $_GET) is the name of the clicked menu ('concert' , 'user', etc)
		{
			if ( file_exists(__DIR__."/prepareDatasPerTable/_prepareDatas_".$entity.".php") )
			{
				require_once(__DIR__."/prepareDatasPerTable/_prepareDatas_".$entity.".php");
			}
		}
	}
?>

<main class="adminpage">
	<!-- DISPLAY MENUS ICONS IF USER GROUP HAVE RIGHT TO SEE IT -->
	<aside class="adminpage-aside">
		<ul class="adminpage-menus">
			<?php foreach ($entities_infos as $menu_infos) :?>
				<?php if ($GLOBALS['user_group_rights'][ $menu_infos['tablename'] ]['can_see'] === true): ?>
					<li class="adminpage-menu">
						<a 
							title="<?= $menu_infos['title_on_hover']?>" 
							href="<?= $_SERVER['PHP_SELF'].'?entity='.$menu_infos['tablename'].'&action=showDashboardOfEntity' ?>" 
							class="adminpage-menu-link"
						>
							<?= $menu_infos['fontawesome_icon']?>
						</a>
					</li>
				<?php endif?>
			<?php endforeach ?>

			<?php //--- here I don't use the array $entities_infos as user require special conditions ?>
			<?php if ($GLOBALS['user_group_rights']['user.webadmin']['can_see'] === true || $GLOBALS['user_group_rights']['user.band_musicians']['can_see'] === true || $GLOBALS['user_group_rights']['user.band_staff']['can_see'] === true || $GLOBALS['user_group_rights']['user.fan']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<a 
						title="Users"
						href="<?= $_SERVER['PHP_SELF'].'?entity=user&action=showDashboardOfEntity' ?>"
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
	
	<!-- DISPLAY DATAS AND FORMS OF CHOSEN TABLE IF USER GROUP HAVE RIGHT TO SEE IT -->
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
				if ( !empty($entity) )
				{
					if ($action === 'showDashboardOfEntity')
					{
						if (file_exists(__DIR__."/dashboardViewPerTable/_dashboardView_".$entity.".php"))
						{
							require_once(__DIR__."/dashboardViewPerTable/_dashboardView_".$entity.".php");
							// require_once(__DIR__."/dashboardViewPerTable/_dashboardView_".$entity."_BACKUP.php");
						}
						else
						{
							print "<h3 style='color:#444; text-align:center;'>Cette page arrivera bientôt !</h3>";
						}
					}
					elseif ($action === 'formEditEntity' || $action === 'formNewEntity')
					{
						if (file_exists(__DIR__."/dashboardViewPerTable/_dashboardForm_".$entity.".php"))
						{
							require_once(__DIR__."/dashboardViewPerTable/_dashboardForm_".$entity.".php");
						}
						else
						{
							print "<h3 style='color:#444; text-align:center;'>Cette page arrivera bientôt !</h3>";
						}
					}
				}
			?>
		</section>
	</div>
</main>