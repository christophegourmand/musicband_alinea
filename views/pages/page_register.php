<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/views/common/sessionStartAndCheck.php"); //NOTE: keep before html, after mysqli


// VARIABLES USED TO BUILD PATH-TO-FILES : 

	$page_name = "page_register"; // used to build paths-to-files

// VARIABLES USED IN HEADER :
	$page_title = "ALINEA musique - Création de compte";
	$page_description = "creation de compte pour les membres d'Alinea.";

// VARIABLES TO ADJUST "common elements" (header, navbar, ...)
	$active_menu_in_navbar = "Création de compte";

// TODO : PLUS TARD METTRE CES VARIABLES DANS UN OBJET. (Un par page + portant le nom de la page + le nom des clés sont les mêmes d'un objet à l'autre.

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/head.php"); ?>

	<body>
		<div class="topPanel" id="indexPage_topPanel">
			<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/usermenu-menus.php"); ?>
			<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/header.php"); ?>

			<div class="topPanel-body">
				<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/pages/".$page_name."/topPanel-body.php"); ?>
			</div>
		</div>
		<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/pages/".$page_name."/page-content.php"); ?>

		<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/footer.php"); ?>

		<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/load_js_scripts.php"); ?>
		
		<!-- custom script, only for this page -->
		<script src="<?php echo('/assets/js/effetOnBloquote_indexPage.js')?>"></script>
		<script src="<?php echo('/assets/js/verifyCharactersRegex.js')?>"></script>
	</body>
</html>

<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");
?>