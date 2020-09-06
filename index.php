<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        
        <?php $page_title = "ALINEA groupe de musique - site Officiel"?>
        <title><?php echo $page_title?></title>

        <meta name="description" content="Site Officiel du groupe de musique ALINEA, pour suivre l'actualité, les dates de concerts, retrouver les photos, vidéos et écouter les albums.">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="icon" href="./assets/img/icons/favicon_alinea_rouge.png">
        
        <!-- FONTS -->
        <script src="https://kit.fontawesome.com/20e04a2320.js" crossorigin="anonymous"></script>
        
        <link href="https://fonts.googleapis.com/css2?family=Mrs+Saint+Delafield&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- STYLE -->
        <link rel="stylesheet" href="assets/css/main_style.css">
    </head>
    <!-- ############################################################################## -->
    <!-- ############################################################################## -->
    <!-- ############################################################################## -->
    <body>
        <header>
            <div class="header-head">
                
                <div class="brand">
                    <!-- <img class="brand-logo" src="/assets/img/icons/Logo_Alinea_red_big.png" alt="logo ALINEA" title="logo ALINEA"> -->
                    <img class="brand-logo" src="/assets/img/icons/Logo_Alinea_red_big.png" alt="logo ALINEA" title="logo ALINEA">
                    <h1 class="brand-name">ALINEA</h1>
                </div>
                <?php include("./views/modules/navbar.php")?>
            
                <div class="header-body">
                    <blockquote class="catchphrase">ALINEA<br>‟ En s'écartant de la ligne ″</blockquote>
                </div>
            </div>
        </header>


        <main>
            <section class="bigquote">
                <blockquote class="bigquote-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo error non vitae maxime a consequuntur eius commodi nostrum ipsum possimus? Rerum labore consectetur cupiditate at repellendus facilis recusandae corrupti! Hic!</blockquote>
                <cite class="bigquote-author">Thierry CIVIDINO</cite>
                <?php include("./views/essai.php")?>
            </section>

            <img class="img-full-page" src="/assets/img/photos/from-CoppaStudio/2020.06.24/SD/alinea_00029_groupe_cropped.jpg" alt="photo des membres du groupe de musique Alinea" title="photo des membres du groupe de musique Alinea">

            <!-- <section class="interactive-flyover">
                <img class="interactive-flyover_img" src="/assets/img/photos/from-CoppaStudio/2020.06.24/SD/alinea_00029_groupe_cropped.jpg" alt="photo des membres du groupe de musique Alinea" title="photo des membres du groupe de musique Alinea">
                <div class="interactive-flyover_result">
                    <p class="result">Simoné</p>
                    <p class="result">Nicole</p>
                    <p class="result">Thierry</p>
                    <p class="result">Nico</p>
                    <p class="result">Ponpon</p>
                </div>
            </section> -->
            

        </main>

        
        <footer>
            <!--
            <nav class="navbtm">
                <ul class="navbtm-menus">
                    <li class="navbtm-item">
                        <a class="navbtm-link" href="#"><i class="fas fa-stream"></i></a>

                    </li>
                    <li class="navbtm-item active">
                        <a class="navbtm-link" href="#"><i class="fas fa-calendar-alt"></i></a>
                    </li>
                    <li class="navbtm-item">
                        <a class="navbtm-link" href="#"><i class="fas fa-photo-video"></i></a>
                    </li>
                    <li class="navbtm-item">
                        <a class="navbtm-link" href="#"><i class="fas fa-users"></i></a>
                    </li>
                    <li class="navbtm-item">
                        <a class="navbtm-link" href="#"><i class="fas fa-envelope"></i></a>
                    </li>
                    <li class="navbtm-item">
                        <a class="navbtm-link" href="#"><i class="fas fa-headphones"></i></a>
                    </li>
                </ul>
            </nav>
            -->
        </footer>

        <script src="./assets/js/mainPage.js"></script>
    </body>
</html>