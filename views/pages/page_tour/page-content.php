<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");
	// require_once($_SERVER['DOCUMENT_ROOT']."/models/Model.class.php"); // REVIEW : utile ?
	require_once($_SERVER['DOCUMENT_ROOT']."/models/Concert.class.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
	

	// SECTION : prepare datas (instances of Concert)
	$dbHandler = new DbHandler();

	//--- load rows datas from table bio where field `active` = 1
	$concertsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'concert', ["active = 1"]);

	//--- create instances of Concert, fill then with rowDatas , then push them in array
	$concertsInstances = [];
	foreach ($concertsRowsFromDb as $concertRowFromDb) {
		$concert = new Concert();
		$concert->fill_from_array($concertRowFromDb);
		array_push($concertsInstances , $concert);
	}

?>

<main>
	<h2 class="page-title">Tour</h2>
	<section class="tour">
		<h3 class="tour-title">Concerts</h3>
		<div class="tour-body">
			<?php  foreach ($concertsInstances as $loopingConcert) :?>
				<div class="tour-event">
					<time class="tour-event-date"><?= $loopingConcert->get_date_french_string()/* .' - à '.$loopingConcert->get_hour_start() */ ?></time>
					<p class="tour-event-location">
						<?= $loopingConcert->get_venue_name() ?>

						<?php if ( !empty($loopingConcert->get_url_map()) ): ?>
							<a class="tour-event-mapIcon" href="<?= $loopingConcert->get_url_map() ?>" target="_blank"><i class="fas fa-map"></i></a>
						<?php endif ?>
					</p>
					<p class="tour-event-city"><?= $loopingConcert->get_city_name() ?></p>
				</div>
			<?php endforeach ?>
		</div>
	</section>
</main>