<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	// require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Bio.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

	// SECTION : prepare datas (instances of Bio)
	$dbHandler = new DbHandler();

	//--- load rows datas from table bio where field `active` = 1
	$biosRowsFromDb = $dbHandler->loadManyRows($mysqli, 'bio', ["active = 1"]);
	// echo '<pre>$biosRowsFromDb<br>';  @var_dump($biosRowsFromDb);  echo '</pre>';  //exit('END');    // DEBUG

	//--- create instances of Bio, fill then with rowDatas , then push them in array
	$biosInstances = [];
	foreach ($biosRowsFromDb as $bioRowFromDb) {
		$bio = new Bio();
		// echo '<pre><h1 style="color:red;">$bio (vide)</h1>';  @var_dump($bio);  echo '</pre>';  //exit('END');    // DEBUG
		$bio->fill_from_array($bioRowFromDb);
		// echo '<pre><h1 style="color:red;">$bio->fill_from_array($bioRowFromDb)</h1>';  @var_dump($bio);  echo '</pre>';  //exit('END');    // DEBUG
		array_push($biosInstances , $bio);
	}
?>

<main>
	<h2 class="page-title">Bio</h2>
	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>
	<section class="musiciens">
		<?php  foreach ($biosInstances as $loopingBio) :?>
			<?php 
				// echo '<pre>loopingBio<br>';  @var_dump($loopingBio);  echo '</pre>';  //exit('END');    // DEBUG 
			?>
			<div class="musiciens-container">
				<h3 class="musiciens-name"><?= $loopingBio->get_firstname() ?><span class="musiciens-name-lastname">&nbsp;<?= $loopingBio->get_lastname() ?></span></h3>
				<div class="musiciens-2col">
					<?php if(!empty($loopingBio->get_path_image())): ?>
						<img class="musiciens-img" src="<?= $loopingBio->get_path_image() ?>" alt="photo du musicien" title="photo du musicien">
					<?php else: ?>
						<img class="musiciens-img" src="" alt="" title="">
					<?php endif ?>
					<p class="musiciens-description"><?= str_replace("\r\n",'<br>', $loopingBio->get_description()) ?></p>
				</div>
				<p class="musiciens-role"><?= @str_replace("\r\n",'<br>', $loopingBio->get_job()) ?></p>
			</div>
		<?php  endforeach ?>
	</section>
</main>