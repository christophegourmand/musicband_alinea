
var menuToggler_node = document.getElementById("nav_toggler");

var menusToShow_node = document.getElementById("nav_menus");
                                                            console.log(menusToShow_node);

// menusToShow_node.classList.add("show");


menuToggler_node.addEventListener("click", function(){
                                                            console.log("cliqué");
        menusToShow_node.classList.toggle("show");
    });




// nav_menus