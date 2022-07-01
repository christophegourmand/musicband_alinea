<?php
		// #################################################### 
		// CONCERTS
		// #################################################### 

		$GLOBALS['fieldsOfTableConcert'] = $dbHandler->getFields($mysqli, 'concert');
		# var_dump($GLOBALS['fieldsOfTableConcert']); // DEBUG


		//--- load rows datas from table bio where field `active` = 1
		$concertsRowsFromDb = $dbHandler->loadManyRows($mysqli, 'concert', ["active = 1"]);

		//--- create instances of Concert, fill then with rowDatas , then push them in array
		$GLOBALS['concertsInstances'] = [];
		foreach ($concertsRowsFromDb as $concertRowFromDb) {
			$concert = new Concert();
			$concert->fill_from_array($concertRowFromDb);
			array_push($GLOBALS['concertsInstances'] , $concert);
		}
		# echo '<pre>';  @var_dump($concertsRowsFromDb);  echo '</pre>';  //exit('END');    //! DEBUG
		# echo '<pre>';  @var_dump($GLOBALS['concertsInstances']);  echo '</pre>';  //exit('END');    //! DEBUG

		$rowidInModifyMode = $_GET['rowidInModifyMode'] ?? -1; // Here I use `-1` instead of `null` to means that we have 
?>