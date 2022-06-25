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

	// SECTION : prepare datas , prepare instances of classes
	if ( isset($_SESSION['user_rowid']) && isset($_SESSION['user_login']) && isset($_SESSION['user_fk_group_rowid']) )
	{
		$user = new User();
		$user->load($mysqli, $_SESSION['user_rowid']);

		$user_group = $user->get_group();
		$authorizedMenusToDisplay = [];

		//--- if user is a part of group 'webadmin' , 'band_musicians' or 'band_staff'
		
		$rightsOfUserGroup_arr = $user_group->get_rights_name_array($mysqli);
		// var_dump($rightsOfUserGroup_arr);

		// #################################################### 
		// CONCERTS
		// #################################################### 

		$GLOBALS['concertsFields'] = $dbHandler->getFields($mysqli, 'concert');

		//--- load rows datas from table bio where field `active` = 1
		$concertsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'concert', ["active = 1"]);

		//--- create instances of Concert, fill then with rowDatas , then push them in array
		$concertsInstances = [];
		foreach ($concertsRowsFromDb as $concertRowFromDb) {
			$concert = new Concert();
			$concert->fill_from_array($concertRowFromDb);
			array_push($concertsInstances , $concert);
		}
		# echo '<pre>';  @var_dump($concertsRowsFromDb);  echo '</pre>';  //exit('END');    //! DEBUG


		// #################################################### 
		// MUSIC ALBUM
		// #################################################### 

		//--- load musicAlbum and musicSongs
		if( in_array($user_group->get_groupname(), ["webadmin", "band_musicians"]) )
		{
			$albumsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'music_album');

			//--- create array of MusicAlbum instances and fill them with datas
			$musicAlbums_list = [];
			foreach ($albumsRowsFromDb as $albumRowFromDb) {
				# var_dump($albumRowFromDb);
				$musicAlbum = new MusicAlbum();
				$musicAlbum->fill_from_array($albumRowFromDb);
				$musicAlbum->load_musicSongs($mysqli);
				array_push($musicAlbums_list , $musicAlbum);
			}

			foreach ($musicAlbum->get_musicSongs() as $musicSongindex => $musicSong)
			{
				// TODO : faire queluechose de ces infos :
				$musicSong->get_rowid();
				$musicSong->get_path_image();
			}
		}
	}

?>

<main class="adminpage">
	<aside class="adminpage-aside">
		<ul class="adminpage-menus">
			<?php if (in_array($user_group->get_groupname(), ['webadmin', 'band_musicians','band_staff'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Concerts</a> -->
					<a href="" class="adminpage-menu-link"><i class="far fa-calendar-alt"></i></a>
				</li>
			<?php endif?>

			<?php if (in_array($user_group->get_groupname(), ['webadmin', 'band_musicians','band_staff'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Albums</a> -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-compact-disc"></i></a>
				</li>
			<?php endif?>

			<?php if (in_array($user_group->get_groupname(), ['webadmin', 'band_musicians','band_staff'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Morceaux</a> -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-music"></i></a>
				</li>
			<?php endif?>
			<?php if (in_array($user_group->get_groupname(), ['webadmin'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Bios</a> -->
					<!-- <a href="" class="adminpage-menu-link"><i class="fas fa-user-astronaut"></i></a> -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-id-card"></i></a>
				</li>
			<?php endif?>

			<?php if (in_array($user_group->get_groupname(), ['webadmin'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Produits</a> -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-tshirt"></i></a>
				</li>
			<?php endif?>
				
			<?php if (in_array($user_group->get_groupname(), ['webadmin'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Utilisateurs</a> -->
					<!-- <a href="" class="adminpage-menu-link"><i class="fas fa-user-friends"></i></a> -->
					<!-- <a href="" class="adminpage-menu-link"><i class="fas fa-id-card"></i></a> -->
				</li>
			<?php endif?>
				
			<?php if (in_array($user_group->get_groupname(), ['webadmin'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Groupes</a> -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-users"></i></a>
				</li>
			<?php endif?>
				
			<?php if (in_array($user_group->get_groupname(), ['webadmin'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Droits</a> -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-users-cog"></i></a>
				</li>
			<?php endif?>
				
			<?php if (in_array($user_group->get_groupname(), ['webadmin','band_staff'])): ?>
				<li class="adminpage-menu">
					<!-- <a href="" class="adminpage-menu-link">Partenaires*</a> -->
					<a href="" class="adminpage-menu-link"><i class="far fa-handshake"></i></a>
				</li>
			<?php endif?>
				
			<?php if (in_array($user_group->get_groupname(), ['webadmin', 'band_musicians','band_staff'])): ?>
				<li class="adminpage-menu">
					<!-- images -->
					<a href="" class="adminpage-menu-link"><i class="fas fa-images"></i></a>
				</li>
			<?php endif?>
		</ul>
	</aside>
	

	<!--
	<p><strong>login:</strong> <?= $user->get_login() ?></p>
	<p><strong>email:</strong> <?= $user->get_email() ?></p>
	<p><strong>groupe:</strong> <?= $user_group->get_groupname() ?></p>
	-->
	<div class="dashboard">
		<h2 class="page-title">Tableau de bord</h2>
		<?php 
			// --- html who display the message if there is a key in $_GET or $_COOKIE :
			include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php");
		?>
		<section class="dashboard-section">
			<h3 class="dashboard-section-title">Concerts</h3>
			<!--
			<table class="datatable">
				<tr class="datatable-line-titles">
					<?php foreach ($GLOBALS['concertsFields'] as $concert_loopingField): ?>
						<th class="datatable-title"><?= $concert_loopingField ?></th>
					<?php endforeach ?>
				</tr>
			</table>
			-->
			<div class="datagrid">
			</div>
			
		</section>
	</div>
</main>