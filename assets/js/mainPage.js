
//* ON 'MOBILE' MODE, DISPLAYING <MENUS PANEL> WHEN BUTTON IS CLICKED. 
    var menuToggler_node = document.getElementById("nav_toggler");

    var menusToShow_node = document.getElementById("nav_menus");

    menuToggler_node.addEventListener("click", function(){
        menusToShow_node.classList.toggle("show");    
    });


//* DETECTION DE LA HAUTEUR À APPLIQUER AUX MENUS EN TUILE (LORS D'UN RESIZE DE FENETRE)
function setHeightForMenusTiles() {
    // (1) OBTAIN WINDOW VISIBLE INNER SIZE,  
    /* (1) obtenir la taille intérieure la partie visible de la fenêtre, ,  */
    var visible_window_interior_size = window.innerHeight;
            // console.debug(`👁‍🗨 visible_window_interior_size: ${visible_window_interior_size}`);
        
    // (2) THEN OBTAIN NAVBAR SIZE.
    // (2) obtenir la taille de la barre de menu.
        // console.debug("👁‍🗨 élément DOM navToggler :");
        // console.debug(menuToggler_node); // console.dir affiche les triangles pour qu'on explore l'objet.
    
    var menuTogglerSize_nbr = menuToggler_node.clientHeight;
        //console.debug(`👁‍🗨 menuTogglerSize_nbr : ${menuTogglerSize_nbr}`);
    
    // (3) THEN SET MENUS-SIZE
    // (3) en fonction de ça, définir la taille des menus en 'tuiles' pour qu'ils prennents la taille restante.
    var menusTiles_node = document.querySelector(".nav .nav-menus");

    if (window.innerWidth < 992 ) {
        console.debug("📐 we are inferior than M, toggler button should be displayed.");
        var menusTilesHeight_nbr = visible_window_interior_size - menuTogglerSize_nbr;
        var menusTilesHeight_str = `${menusTilesHeight_nbr}px`;
            // console.debug(`👁‍🗨 menusTilesHeight_str : ${menusTilesHeight_str}`);
        menusTiles_node.style.height = menusTilesHeight_str;

    } else {
        menusTiles_node.style.height = "";
    }
    
    // (4) KEEP TRACK OF HOW MANY TIME THE RESIZE HAPPENED:
    var counterLabel = "COUNT OF RESIZE-EVENT";
    console.count(counterLabel);

    console.info("✅ DONE: height of menus has been changed !");
}

window.addEventListener("resize", setHeightForMenusTiles );


//* ANIMATION ON PAGE 'CONTACT' ========================================================

var listOfSectionsContact_arr = Array.from( document.querySelectorAll(".contact") );

console.log(listOfSectionsContact_arr[1]);
/* 
    next step: 
        1- detecter à quel moment une section (par ex: Coppa Studio), est au milieu de l'écran.
        2- ajouter des events listener
        3- faire que le background devienne darkred quand c'est le cas.

        = ainsi, ça fonctionnera aussi sur Mobile. 
        (car pour l'instant j'ai mis un :hover qui fonctionne seulement sur pc).
*/


// TEST DE << window.scrollY >> ET << addEventListner("scroll", callback(event){...} ); >>

    // j'ajoute un detecteur de scroll sur le document (la page web entière)
    /*
    document.addEventListener('scroll', function(eventSrollWhoIsHappening){
        console.log(eventSrollWhoIsHappening);
        console.log(window.scrollY);
    });
    */
    // OK J'ARRIVE À SAVOIR QUELLE EST MA POSITION DE SCROLL DANS LA PAGE.
    // MAINTENANT JE DOIS RÉUSSIR À CONNAÎTRE LA POSITION DE L'ÉLÉMENT AVANT, ET CELUI APRÈS, L'ÉLÉMENT QUE JE VEUX ANIMER


function animateElementOnAppear(element_node, cssClassToAdd_str){
    var elementPositionTop = element_node.offsetTop;
    var elementHeight = element_node.offsetHeight;
    var elementPositionBottom = elementPositionTop + elementHeight;

    window.addEventListener('scroll', function(event){
        scrollPositionY = window.scrollY;
        if (scrollPositionY > elementPositionBottom ) {
            element_node.classList.add(cssClassToAdd_str);
        }
    });
}


//* ANIMATION ON PAGE 'HOME' ========================================================
    window.addEventListener('scroll', function(event){
        
        // Position de la div social_media depuis le haut:
            divSocialMedia_node = document.getElementById('socialMedia_id');
            positionDivSocialMedia_nbr = divSocialMedia_node.offsetTop; // en largeur LG :  environ 1275px
                /* cette valeur signifie : pour que la div socialMedia se trouve en haut de la fenêtre*/
            //console.debug(`positionDivSocialMedia_nbr: ${positionDivSocialMedia_nbr}` );
    
        
            // position actuelle du scroll dans la page:
            scrollPositionY = window.scrollY;
            console.debug(`window.scrollY: ${window.scrollY}` );
            
            // detecter si on a scrollé au point d'afficher la divSocialMedia :
            /*
            - à 676px de scroll: debut d'apparition de la div socialMedia
            - a 947 de scroll: les 3 icones sont finies d'être affichées.
            */

            var socialMediaIcons = Array.from(document.getElementsByClassName("socialMedia-link"));
                                                                            // console.log("socialMediaIcons");
                                                                            // console.log(socialMediaIcons);

            if (scrollPositionY > 1020 ) {
                                                                            console.info("PLAY ANIMATION");
                
                // var delayBeforeAppear = 300;
                                                            console.debug(socialMediaIcons);
                socialMediaIcons.forEach( function(element) {
                    //element.style.transitionDelay = delayBeforeAppear + 150;
                                                                            // console.debug(delayBeforeAppear);
                    element.classList.add("play-animation");
                });

                
            }
    });    


        // VOIR NOTION POUR CONTINUER : https://www.notion.so/j-essaye-de-faire-se-d-clencher-des-l-ments-lors-du-scroll-b682364901304fb8abd2da4ad4d719ba
        // et VOIR CETTE PAGE : https://stackoverflow.com/questions/487073/how-to-check-if-element-is-visible-after-scrolling 
        
        