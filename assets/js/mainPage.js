
// ON 'MOBILE' MODE, DISPLAYING <MENUS PANEL> WHEN BUTTON IS CLICKED. 
    var menuToggler_node = document.getElementById("nav_toggler");

    var menusToShow_node = document.getElementById("nav_menus");

    menuToggler_node.addEventListener("click", function(){
        menusToShow_node.classList.toggle("show");    
    });
