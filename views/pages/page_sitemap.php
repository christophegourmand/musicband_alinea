<?php  
    require_once($_SERVER['DOCUMENT_ROOT']."/views/modules/mysqli_create.php");

// VARIABLES USED TO BUILD PATH-TO-FILES :
    $page_name = "page_sitemap"; // used to build paths-to-files


// VARIABLES USED IN HEADER :
    $page_title = "ALINEA musique - Plan du site";
    $page_description = "Plan du site Alinéa";

// VARIABLES TO ADJUST "common elements" (header, navbar, ...)
    $active_menu_in_navbar = "Plan du site";
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include($_SERVER['DOCUMENT_ROOT']."/"."views/common/head.php"); ?>

    <body>
        <div class="topPanel">
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