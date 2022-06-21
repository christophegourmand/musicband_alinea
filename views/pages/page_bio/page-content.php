<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	// require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Bio.class.php");

	// SECTION : prepare datas (instances of Bio)
	$dbHandler = new DbHandler();

	//--- load rows datas from table bio where field `active` = 1
	$biosRowsFromDb = $dbHandler->loadManyRows($mysqli, 'bio', ["active = 1"]);

	//--- create instances of Bio, fill then with rowDatas , then push them in array
	$biosInstances = [];
	foreach ($biosRowsFromDb as $bioRowFromDb) {
		$bio = new Bio();
		$bio->fill_from_array($bioRowFromDb);
		array_push($biosInstances , $bio);
	}
?>

<main>
	<h2 class="page-title">Bio</h2>
	<section class="musiciens">
		<?php  foreach ($biosInstances as $loopingBio) :?>
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
				<p class="musiciens-role"><?= str_replace("\r\n",'<br>', $loopingBio->get_job()) ?></p>
			</div>
		<?php  endforeach ?>
	</section>
</main>