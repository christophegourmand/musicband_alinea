
// ON 'MOBILE' MODE, DISPLAYING <MENUS PANEL> WHEN BUTTON IS CLICKED. 
    var menuToggler_node = document.getElementById("nav_toggler");

    var menusToShow_node = document.getElementById("nav_menus");

    menuToggler_node.addEventListener("click", function(){
        menusToShow_node.classList.toggle("show");    
    });


function setHeightForMenusTiles() {
}

setHeightForMenusTiles(); // works

// window.addEventListener("resize", setHeightForMenusTiles()); // doesnt work.
window.addEventListener("resize", function(){

        // (1) OBTAIN WINDOW VISIBLE INNER SIZE,  
        /* (1) obtenir la taille intérieure la partie visible de la fenêtre, ,  */
        var visible_window_interior_size = window.innerHeight;
            console.debug(`👁‍🗨 visible_window_interior_size: ${visible_window_interior_size}`);
            
        // (2) THEN OBTAIN NAVBAR SIZE.
        // (2) obtenir la taille de la barre de menu.
        console.debug("👁‍🗨 élément DOM navToggler :");
        console.debug(menuToggler_node); // console.dir affiche les triangles pour qu'on explore l'objet.
        
        var menuTogglerSize_nbr = menuToggler_node.clientHeight;
        console.debug(`👁‍🗨 menuTogglerSize_nbr : ${menuTogglerSize_nbr}`);
        
        // (3) THEN SET MENUS-SIZE
        // (3) en fonction de ça, définir la taille des menus en 'tuiles' pour qu'ils prennents la taille restante.
            var menusTiles_node = document.querySelector(".nav .nav-menus");
        
            if (window.innerWidth < 992 ) {
                console.debug("📐 we are inferior than M, toggler button should be displayed.");
                var menusTilesHeight_nbr = visible_window_interior_size - menuTogglerSize_nbr;
                var menusTilesHeight_str = `${menusTilesHeight_nbr}px`;
                            console.debug(`👁‍🗨 menusTilesHeight_str : ${menusTilesHeight_str}`);
                menusTiles_node.style.height = menusTilesHeight_str;

            } else {
                menusTiles_node.style.height = "";
            }
    
    // KEEP TRACK OF HOW MANY TIME THE RESIZE HAPPENED:
    var counterLabel = "COUNT OF RESIZE-EVENT";
    console.count(counterLabel);

    console.info("✅ DONE: height of menus has been changed !");
} );