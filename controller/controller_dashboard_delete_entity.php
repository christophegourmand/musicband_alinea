<?php
	//--- open database connection
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");

	//--- import other files and classes
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");


	//--- get variables from GET and POST
	$entityClassname = $_GET['entityClassname'] ?? '';
	$action = $_GET['action'] ?? '';
	$rowidOfEntityToDelete = ( isset($_GET['rowid']) && !empty($_GET['rowid']) ) ? (int) $_GET['rowid'] : -1;
	
	//--- prepare variable
	$entityIsDeleted = null;

	//--- if conditions succeed , delete the line of the correct table in database (using its php class)
	if ($entityClassname !== '' && $action === 'deleteEntity' && $rowidOfEntityToDelete > 0)
	{
		require_once($_SERVER['DOCUMENT_ROOT']."/models/".$entityClassname.".class.php");

		$entityToDelete = new $GLOBALS['entityClassname']();
		$entityToDelete->set_rowid($rowidOfEntityToDelete);
		$entityIsDeleted = $entityToDelete->delete($mysqli); //--- the method `delete()` return a bool saying if deleted or not
	}

	//--- close database (we do it before redirection)
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");

	//SECTION : we must send back the user to this page :
		# /views/pages/page_dashboard.php?entityClassname=Concert&action=showDashboardOfEntity
	//--- prepare params
	$urlParams = '?';
	$urlParams .= 'entityClassname='.$entityClassname;
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
	header('Location: '.'/views/pages/page_dashboard.php'.$urlParams);
	exit();
?>