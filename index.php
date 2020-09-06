<!DOCTYPE html>
<html lang="fr">
    <?php include("./views/modules/head.php"); ?>
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
                
                <?php include("./views/modules/navbar.php"); ?>
            
                <div class="header-body">
                    <blockquote class="catchphrase">ALINEA<br>‟ En s'écartant de la ligne ″</blockquote>
                </div>
            </div>
        </header>


        <main>
            <section class="bigquote">
                <blockquote class="bigquote-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo error non vitae maxime a consequuntur eius commodi nostrum ipsum possimus? Rerum labore consectetur cupiditate at repellendus facilis recusandae corrupti! Hic!</blockquote>
                <cite class="bigquote-author">Thierry CIVIDINO</cite>
                <?php include("./views/essai.php"); ?>
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

        <?php include("./views/modules/footer.php"); ?>
        

        <script src="./assets/js/mainPage.js"></script>
    </body>
</html>