<?php
	//--- open database connection
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");

	//--- import other files and classes
	
	require_once($_SERVER['DOCUMENT_ROOT']."/debug/debug_functions.php");
	
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/models/DbHandler.class.php");


	//--- get variables from GET and POST
	$GLOBALS['entityClassname'] = $_POST['entityClassname'] ?? '';

	$action = $_POST['action'] ?? '';

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
	# var_dump($entityInstance::$fieldsInfos); exit; // DEBUG
	
	/* --- EXAMPLE of   $entityInstance::$fieldsInfos
		--- contain the same for all fields presents in database :
		'date' => 
			array (size=10)
			'fieldnameInSql' => string 'date' (length=4)
			'fieldnameInHtml' => string 'date' (length=4)
			'canBeDisplayed' => boolean true
			'canBeSet' => boolean true
			'htmlInputType' => string 'date' (length=4)
			'phpType' => string 'string' (length=6)
			'idAttribute' => string 'concert_date' (length=12)
			'nameAttribute' => string 'date' (length=4)
			'attribute_required' => string '' (length=0)
			'attribute_readonly' => string '' (length=0)
	 */


	# $fieldsInfosForForm = $entityInstance->fieldsInfosForForm($mysqli); // NOTE : Useless now
			# showInHtml($fieldsInfosForForm, '$fieldsInfosForForm'); // DEBUG

	# $fieldsToPrintInForm = $GLOBALS['entityClassname']::$fieldsToPrintInForm; // NOTE : Useless now
			# showInHtml($fieldsToPrintInForm , '$fieldsToPrintInForm'); // DEBUG


	function affectValuesFromFormToEntityInstance()
	{
		global $entityInstance;

		//--- foreach static array `$fieldsInfos` , if the field can be set, inject received value form form in `set_.....()`  method
		foreach($GLOBALS['entityClassname']::$fieldsInfos as $key_fieldname => $fieldInfos)
		{
			# var_dump($fieldInfos);  // DEBUG
			if ($fieldInfos['canBeSet'])
			{
				$setMethodName = 'set_'.$fieldInfos['fieldnameInSql'];
				# var_dump($setMethodName); // DEBUG

				$valueFromForm = $_POST[ $key_fieldname ] ?? null;
				# var_dump($valueFromForm); // DEBUG
				settype($valueFromForm , $fieldInfos['phpType']);
				# var_dump($valueFromForm); // DEBUG

				$entityInstance->$setMethodName($valueFromForm); // TODO : à reéactiver si chaque $valueFromForm me parait correcte
			}
		}
	}


	// =======================================================================
	// SECTION : update
	// =========================================================================
	if ($action === 'updateEntity' && $rowidOfEntityToUpdate > 0)
	{
		//--- fill the instance with values from database before any update is made
		$entityInstance->load($mysqli , $rowidOfEntityToUpdate);

		affectValuesFromFormToEntityInstance(); //--- fill-up $entityInstance

		$entityInstance->update($mysqli);
	}


	// =========================================================================
	// SECTION : create
	// =========================================================================
	if ($action === 'createEntity' )
	{
		affectValuesFromFormToEntityInstance(); //--- fill-up $entityInstance

		$entityInstance->create($mysqli);
	}
	


	//--- close database (we do it before redirection)
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");


	//SECTION : we must send back the user to this page :
		# /views/pages/page_dashboard.php?entityClassname=Concert&action=showDashboardOfEntity
	//--- prepare params
	$urlParams = '?';
	$urlParams .= 'entityClassname='.$GLOBALS['entityClassname'];
	$urlParams .= '&action=showDashboardOfEntity';
	
	if($entityIsDeleted === null || $entityIsDeleted === false)
	{
		$messageKey = "entityCanNotBeDeleted";
	} else if ($entityIsDeleted)
	{
		$messageKey = "entityHasBeenDeletedWell";
	}
	$urlParams .= '&messageKey='.$messageKey;



	//--- redirect on previous page using prepared params
	
	header('Location: '.'/views/pages/page_dashboard.php'.$urlParams);
	exit();
?>