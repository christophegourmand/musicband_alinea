<?php

// VARIABLES USED TO BUILD PATH-TO-FILES : 
    // $prefix_to_root_folder =   IS NOT DEFINED HERE   -->    is defined in "index.php" where this file is loaded.

    $page_name = "page_index"; // used to build paths-to-files

// VARIABLES USED IN HEADER :
    $page_title = "ALINEA groupe de musique - site Officiel";
    $page_description = "Site Officiel du groupe de musique ALINEA, pour suivre l'actualité, les dates de concerts, retrouver les photos, vidéos et écouter les albums.";

// VARIABLES TO ADJUST "common elements" (header, navbar, ...)
    $active_menu_in_navbar = "index";


// TODO : PLUS TARD METTRE CES VARIABLES DANS UN OBJET. (Un par page + portant le nom de la page + le nom des clés sont les mêmes d'un objet à l'autre.

?>

<!DOCTYPE html>
<html lang="fr">
    <?php include($prefix_to_root_folder."views/common/head.php"); ?>

    <body>
        <div class="topPanel full-height" id="indexPage_topPanel">
            <?php include($prefix_to_root_folder."views/common/header.php"); ?>

            <div class="topPanel-body">
                <?php include($prefix_to_root_folder."views/pages/".$page_name."/topPanel-body.php"); ?>
            </div>
        </div>
        <?php include($prefix_to_root_folder."views/pages/".$page_name."/page-content.php"); ?>

        <?php include($prefix_to_root_folder."views/common/footer.php"); ?>

        <?php include($prefix_to_root_folder."views/common/load_js_scripts.php"); ?>
    </body>
</html>