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

	// SECTION - variables from $_GET and $_POST
	$action = $_GET['action'] ?? '';
	$rowid_from_get = $_GET['rowid'] ?? -1;
	$GLOBALS['entityClassname'] = $_GET['entityClassname'] ?? ''; // --- `$GLOBALS['entityClassname']` is the name of the clicked menu ('concert' , 'user', etc)


	//--- create instance of DbHandler , used to load many rows from database
	$dbHandler = new DbHandler();

	//--- prepare array of menus informations
		// NOTE : old name : `entities_infos` , new name : `entities_list`
	$GLOBALS['entities_list'] = [
		'Concert'
		, 'MusicAlbum'
		, 'MusicSong'
		, 'Bio'
		, 'Group'
		# , 'User'
		# ,'Product' // NOTE this class does not exist yet, only a table in database exists.
		# , 'AssoGroupRight' // NOTE this class does not exist yet, only a table in database exists.
		# , 'Partner' // NOTE this class does not exist yet, neither table in database.
		# , 'Photo' // NOTE : this Class is not in relation with the database, so keep this line off until you figure-out how you will handle the dashboard and forms.
		# , 'Album' // NOTE : this Class is not in relation with the database, so keep this line off until you figure-out how you will handle the dashboard and forms.
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
		if ($GLOBALS['entityClassname'] !== '' /* && $action === 'showDashboardOfEntity' */) // --- `$GLOBALS['entityClassname']` (from $_GET) is the name of the clicked menu ('concert' , 'user', etc)
		{

			if ( file_exists(__DIR__."/prepareDatasPerTable/_prepareDatas.php") )
			{
				require_once(__DIR__."/prepareDatasPerTable/_prepareDatas.php");
			}
		}
	}
?>



<main class="adminpage">
	<!-- DISPLAY MENUS ICONS IF USER GROUP HAVE RIGHT TO SEE IT -->
	<aside class="adminpage-aside">
		<ul class="adminpage-menus">
			<?php foreach ($GLOBALS['entities_list'] as $looping_entityClassname) :?>
				<?php if ($GLOBALS['user_group_rights'][ $looping_entityClassname::TABLENAME ]['can_see'] === true): ?>
					<li class="adminpage-menu">
						<a 
							title="<?= $looping_entityClassname::$explanation ?>" 
							href="<?= $_SERVER['PHP_SELF'].'?entityClassname='.$looping_entityClassname.'&action=showDashboardOfEntity' ?>" 
							class="adminpage-menu-link"
						>
							<?= $looping_entityClassname::$iconHtml ?>
						</a>
					</li>
				<?php endif?>
			<?php endforeach ?>

			<?php //--- here I don't use the array $GLOBALS['entities_list'] as user require special conditions ?>
			<?php if ($GLOBALS['user_group_rights']['user.webadmin']['can_see'] === true || $GLOBALS['user_group_rights']['user.band_musicians']['can_see'] === true || $GLOBALS['user_group_rights']['user.band_staff']['can_see'] === true || $GLOBALS['user_group_rights']['user.fan']['can_see'] === true): ?>
				<li class="adminpage-menu">
					<a 
						title="<?= User::$explanation ?>"
						href="<?= $_SERVER['PHP_SELF'].'?entityClassname=User&action=showDashboardOfEntity' ?>"
						class="adminpage-menu-link"
					>
						<?= User::$iconHtml ?>
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
				if ( !empty($GLOBALS['entityClassname']) )
				{
					if ($action === 'showDashboardOfEntity')
					{
						if (file_exists(__DIR__."/dashboardViewPerTable/_dashboardView.php"))
						{
							require_once(__DIR__."/dashboardViewPerTable/_dashboardView.php");
						}
						else
						{
							print "<h3 style='color:#444; text-align:center;'>Cette page arrivera bientôt !</h3>";
						}
					}
					elseif ($action === 'formEditEntity' || $action === 'formNewEntity')
					{
						if (file_exists(__DIR__."/dashboardViewPerTable/_dashboardForm.php"))
						{
							require_once(__DIR__."/dashboardViewPerTable/_dashboardForm.php");
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