    <head>
        <meta charset="utf-8">
        
        <title><?php echo $page_title; ?></title>

        <meta name="description" content="<?php echo $page_description; ?>">
        <meta name="creator" content="Christophe GOURMAND - Developpeur Web">
        <meta name="keywords" content="musique, groupe, france, variété française, rock français">
        <meta name="robots" content="index, follow, noarchive, nocache">

        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <link rel="icon" href="/assets/img/icons/Logo_Alinea_white_big.png">
        
        <!-- FONTS -->
        <script src="https://kit.fontawesome.com/20e04a2320.js" crossorigin="anonymous"></script>
        
        <link href="https://fonts.googleapis.com/css2?family=Mrs+Saint+Delafield&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- STYLE -->
        <link rel="stylesheet" href="<?php echo($prefix_to_root_folder."assets/css/main_style.css")?>">

        <?php 
            try {
                require_once($prefix_to_root_folder.".env.php");
                // if (isset($env)) {
                    echo("<script>const ENV='$env';</script>");
                    echo("<script>console.info('Environnement:');</script>");
                    echo("<script>console.info(ENV);</script>");
                // }
            } catch (Exception $e){
                echo("<script>console.warn($e);</script>");
            }
        ?>
    </head>