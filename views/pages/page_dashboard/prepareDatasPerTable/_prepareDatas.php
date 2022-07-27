<?php
		if ( $action === 'showDashboardOfEntity' )
		{
			$GLOBALS['entity_tableFields'] = $dbHandler->getFieldsNames($mysqli, $GLOBALS['entityClassname']::TABLENAME);
			# var_dump($GLOBALS['entity_tableFields']); // DEBUG

			//--- if a particular condition in sql SELECT is required , program it here :
			# $sqlConditionToSelectRows = ( in_array('active', $GLOBALS['entity_tableFields']) ) ? ["active = 1"] : [];
			//--- if no conditions required, use this line instead :
			$sqlConditionToSelectRows = [];

			$entityRowsFromDb = $dbHandler->loadManyRows($mysqli, $GLOBALS['entityClassname']::TABLENAME , $sqlConditionToSelectRows );

			//--- create instances of Concert, fill then with rowDatas , then push them in array
			$GLOBALS['entityInstances'] = [];
			foreach ($entityRowsFromDb as $entityRowFromDb) {
				$GLOBALS['entityInstance'] = new $GLOBALS['entityClassname']();
				$GLOBALS['entityInstance']->fill_from_array($entityRowFromDb);
				array_push($GLOBALS['entityInstances'] , $GLOBALS['entityInstance']);
			}
			# echo '<pre>';  @var_dump($entityRowsFromDb);  echo '</pre>';  //exit('END');    //! DEBUG
			# echo '<pre>';  @var_dump($GLOBALS['entityInstances']);  echo '</pre>';  //exit('END');    //! DEBUG

			$rowidInModifyMode = $_GET['rowidInModifyMode'] ?? -1; // Here I use `-1` instead of `null` to means that we have 
		}
		elseif ($action === 'formEditEntity' || $action === 'formNewEntity')
		{
			$GLOBALS['entityInstance'] = new $GLOBALS['entityClassname']();
			
			if ($action === 'formEditEntity')
			{
				$rowid_from_get = (int) $_GET['rowid'];

				if($rowid_from_get > 0)
				{
					$GLOBALS['entityInstance']->load($mysqli, $rowid_from_get);
				}
			}
		}
?>