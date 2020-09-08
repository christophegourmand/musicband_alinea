
// ON 'MOBILE' MODE, DISPLAYING <MENUS PANEL> WHEN BUTTON IS CLICKED. 
    var menuToggler_node = document.getElementById("nav_toggler");

    var menusToShow_node = document.getElementById("nav_menus");
                                                                // console.log(menusToShow_node);
    // menusToShow_node.classList.add("show");
                                                                // TODO : ajouter le déclenchement au 'touch', pas seulement au 'click'
    menuToggler_node.addEventListener("click", function(){
                                                                // console.log("cliqué");
            menusToShow_node.classList.toggle("show");
        });

// xxxxxxxxxxxxxxxxxx : 

                                        console.log("mainPage.js Loaded");