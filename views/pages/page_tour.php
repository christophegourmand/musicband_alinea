<?php 
// VARIABLES USED TO BUILD PATH-TO-FILES :
    $prefix_to_root_folder = "../../";
    $page_name = "page_tour"; // used to build paths-to-files


// VARIABLES USED IN HEADER :
    $page_title = "ALINEA musique - Tour";
    $page_description = "Dates de concerts et lancements d'albums";

// VARIABLES TO ADJUST "common elements" (header, navbar, ...)
    $active_menu_in_navbar = "Tour";
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include($prefix_to_root_folder."views/common/head.php"); ?>

    <body>
        <div class="topPanel">
            <?php include($prefix_to_root_folder."views/common/header.php"); ?>

            <div class="topPanel-body">
                <?php include($prefix_to_root_folder."views/pages/".$page_name."/topPanel-body.php"); ?>
            </div>
        </div>

        <?php include($prefix_to_root_folder."views/pages/".$page_name."/page-content.php"); ?>
        
        <?php include($prefix_to_root_folder."views/common/footer.php"); ?>
        <?php require_once($prefix_to_root_folder."views/common/load_js_scripts.php"); ?>
    </body>
</html>