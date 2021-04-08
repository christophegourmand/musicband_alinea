
// ON 'MOBILE' MODE, DISPLAYING <MENUS PANEL> WHEN BUTTON IS CLICKED. 
    var menuToggler_node = document.getElementById("nav_toggler");

    var menusToShow_node = document.getElementById("nav_menus");

    menuToggler_node.addEventListener("click", function(){
        menusToShow_node.classList.toggle("show");    
    });


// ANIMATION ON PAGE 'CONTACT'

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