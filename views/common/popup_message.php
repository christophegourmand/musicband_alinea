<?php
	if (isset($_GET['messageKey']) || isset($_COOKIE['messageKey']) )
	{
		if ( isset($_GET['messageKey']) )
		{
			$GLOBALS['messageKey'] = $_GET['messageKey'];
		} elseif ( isset($_COOKIE['messageKey']) )
		{
			$GLOBALS['messageKey'] = $_COOKIE['messageKey'];
		}
		$popupMessage_arr = getMessageFromKey($GLOBALS['messageKey']);
	} elseif (isset($_GET['customMessage']) && isset($_GET['cssclass']))
	{
		$popupMessage_arr = getMessageFromCustomMessage($_GET['customMessage'], $_GET['cssclass']);
	}

?>

<?php if( isset($popupMessage_arr)): ?>
	<div id="popupmessage" class="popupmessage-container show">
		<div class="popupmessage <?= $popupMessage_arr['cssclass'] ?>">
			<div class="close-button" id="popupmessage_btn_close">
				<i class="fas fa-times"></i>
			</div>
			<div class="popupmessage-body">
				<p class="popupmessage-message"><?= $popupMessage_arr['text'] ?></p>
			</div>
		</div>
	</div>
<?php endif ?>