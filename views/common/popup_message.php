<?php
	if (isset($_GET['messageKey']) || isset($_COOKIE['messageKey']))
	{
		if (isset($_GET['messageKey']))
		{
			$messageKey = $_GET['messageKey'];
		} elseif (isset($_COOKIE['messageKey']))
		{
			$messageKey = $_COOKIE['messageKey'];
		}
		$popupMessage_arr = getMessageFromKey($messageKey);
	}
?>

<?php if(isset($popupMessage_arr)): ?>
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