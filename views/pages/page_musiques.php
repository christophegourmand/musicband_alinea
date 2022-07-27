<?php  
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/views/common/sessionStartAndCheck.php"); //NOTE: keep before html, after mysqli

// VARIABLES USED TO BUILD PATH-TO-FILES :
	$page_name = "page_musiques"; // used to build paths-to-files


// VARIABLES USED IN HEADER :
	$page_title = "ALINEA musique - Musiques";
	$page_description = "Morceaux, paroles, et plus";

// VARIABLES TO ADJUST "common elements" (header, navbar, ...)
	$active_menu_in_navbar = "Musiques";

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/head.php"); ?>

	<body>
		<div class="topPanel">
			<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/usermenu-menus.php"); ?>
			<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/header.php"); ?>

			<div class="topPanel-body">
				<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/pages/".$page_name."/topPanel-body.php"); ?>
			</div>
		</div>

		<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/pages/".$page_name."/page-content.php"); ?>
		
		<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/footer.php"); ?>
		<?php require_once($_SERVER['DOCUMENT_ROOT']."/"."views/common/load_js_scripts.php"); ?>
	</body>
</html>

<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");
?>