<?php
	//--- open database connection
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");

	//--- import other files and classes
	
	require_once($_SERVER['DOCUMENT_ROOT']."/debug/debug_functions.php"); // DEBUG
	
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");


	//--- get variables from GET and POST
	$GLOBALS['entityClassname'] = $_POST['entityClassname'] ?? ''; // --- `$GLOBALS['entityClassname']` is the name of the clicked menu ('concert' , 'user', etc)

	$action = $_POST['action'] ?? '';
	//--- vrai ligne: 
	$rowidOfEntityToUpdate = ( isset($_POST['rowid']) && !empty($_POST['rowid']) ) ? (int) $_POST['rowid'] : -1;

	// =======================================================================
	// SECTION : guard : if one of theses conditions are not respected, we can NOT proceed to update or create
	// =======================================================================
	if ( empty($GLOBALS['entityClassname']) || (! in_array($action , ['updateEntity', 'createEntity']) )  )
	{
		// --- we send back the user on the same form he was on, with a message
		$messageKey = 'formControllerReceivedWrongParameters';
		header('Location: '.$_SERVER['HTTP_REFERER'].'&messageKey='.$messageKey);
		exit();
	}


	// =======================================================================
	// SECTION : Prepare `update` or `create`
	// =========================================================================

	//--- prepare variable
	$entityIsUpdated = null;

	//--- load class of entity
	require_once($_SERVER['DOCUMENT_ROOT']."/models/".$GLOBALS['entityClassname'].".class.php");

	$entityInstance = new $GLOBALS['entityClassname']();

	$fieldsInfosForForm = $entityInstance->fieldsInfosForForm($mysqli);
			showInHtml($fieldsInfosForForm, '$fieldsInfosForForm');

	$fieldsToPrintInForm = $GLOBALS['entityClassname']::$fieldsToPrintInForm;
			showInHtml($fieldsToPrintInForm , '$fieldsToPrintInForm');

	var_dump(get_defined_vars()); exit; // DEBUG

	// =======================================================================
	// SECTION : update
	// =========================================================================
	if ($action === 'updateEntity' && $rowidOfEntityToUpdate > 0)
	{
		//--- fill the instance with values from database before any update is made
		$entityInstance->load($mysqli , $rowidOfEntityToUpdate);

		/*
		foreach($GLOBALS['entityClassname']::$fieldsToPrintInForm as $fieldArray)
		{
			if ($fieldArray['canBeSet'])
			{
				$setMethodName = 'set_'.$fieldArray['fieldnameinSql'];
				$entityInstance->$setMethodName();
			}
		}
		*/
	}


	// =========================================================================
	// SECTION : create
	// =========================================================================
	if ($action === 'createEntity' > 0)
	{
	}
	

	//--- if conditions succeed , delete the line of the correct table in database (using its php class)
	/*
	if ($GLOBALS['entityClassname'] !== '' && $action === 'updateEntity' && $rowidOfEntityToDelete > 0)
	{

		$entityInstance->set_rowid($rowidOfEntityToUpdate);
		$entityIsUpdated = $entityInstance->update($mysqli); //--- the method `update()` return a bool saying if updated or not
	}
	*/

	//--- close database (we do it before redirection)
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");



	exit();

	//SECTION : we must send back the user to this page :
		# /views/pages/page_dashboard.php?entityClassname=Concert&action=showDashboardOfEntity
	//--- prepare params
	$urlParams = '?';
	$urlParams .= 'entityClassname='.$GLOBALS['entityClassname'];
	$urlParams .= '&action=showDashboardOfEntity';
	
	if($entityIsDeleted === null || $entityIsDeleted === false)
	{
		$messagekey = "entityCanNotBeDeleted";
	} else if ($entityIsDeleted)
	{
		$messagekey = "entityHasBeenDeletedWell";
	}
	$urlParams .= '&messagekey='.$messagekey;



	//--- redirect on previous page using prepared params
	/* 
	header('Location: '.'/views/pages/page_dashboard.php'.$urlParams);
	exit(); */
?>