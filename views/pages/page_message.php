<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/views/common/sessionStartAndCheck.php"); //NOTE: keep before html, after mysqli


// VARIABLES USED TO BUILD PATH-TO-FILES : 

	$page_name = "page_message"; // used to build paths-to-files

// VARIABLES USED IN HEADER :
	$page_title = "ALINEA musique - Messages";
	$page_description = "Alinea : ici s'affiche les messages";

// VARIABLES TO ADJUST "common elements" (header, navbar, ...)
	$active_menu_in_navbar = "Message";

// TODO : PLUS TARD METTRE CES VARIABLES DANS UN OBJET. (Un par page + portant le nom de la page + le nom des clés sont les mêmes d'un objet à l'autre.

// TODO : mettre tout ce qui concerne la session dans un fichier commun et faire un include_once ici (AVANT LE DOCTYPE !)
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
	<?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/head.php"); ?>

	<body>
		<div class="topPanel" id="indexPage_topPanel">
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
	</body>
</html>

<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_close.php");
?>