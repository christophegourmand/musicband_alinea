<?php
/*
    la navbar est importée dans une page. 

    la page va nous passer une variable 
        ex :  $active_menu_in_navbar = "Photos"

    si le texte du menu correspond à la variable $active_menu_in_navbar , alors écrire 'active'

*/
?>

<nav class="nav" id="main_navbar">
    <!-- <a href="index.html" class="nav-brand"><span>ALINEA</span></a> -->
    <button type="button" class="nav-toggler" id="nav_toggler"><i class="fas fa-bars"></i></button>

    <div class="nav-scoring">
        <div class="nav-scoring-line"></div>
        <div class="nav-scoring-line"></div>
        <div class="nav-scoring-line"></div>
        <div class="nav-scoring-line"></div>
        <div class="nav-scoring-line"></div>
    </div>
    <ul class="nav-menus" id="nav_menus">
        <li class="nav-item bg-music">
            <a href="#" class="nav-link">
                <span class="nav-link-title">Musique</span>
            </a>
        </li>
        <div class="nav-note"></div>
        <li class="nav-item bg-photos active">
            <a href="<?php echo($prefix_to_root_folder."views/pages/page_photos.php"); ?>" class="nav-link">
                <span class="nav-link-title">Photos</span>
            </a>
        </li>
        <div class="nav-note"></div>
        <li class="nav-item bg-actu">
            <a href="#" class="nav-link">
                <span class="nav-link-title">Actu</span>
            </a>
        </li>
        <div class="nav-note"></div>
        <li class="nav-item bg-tour">
            <a href="#" class="nav-link">
                <span class="nav-link-title">Tour</span>
            </a>
        </li>
        <div class="nav-note"></div>
        <li class="nav-item bg-contact">
            <a href="#" class="nav-link">
                <span class="nav-link-title">Contact</span>
            </a>
        </li>
        <div class="nav-note"></div>
        <li class="nav-item bg-bio">
            <a href="#" class="nav-link">
                <span class="nav-link-title">Bio</span>
            </a>
        </li>
        <div class="nav-note"></div>
        <li class="nav-item bg-acheter">
            <a href="#" class="nav-link">
                <span class="nav-link-title">Acheter</span>
            </a>
        </li>
    </ul>
</nav>

<script>
    console.log(" <?php echo($active_menu_in_navbar);?> ");
</script>
