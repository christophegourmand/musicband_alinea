
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

// ON MOBILE , adjusting the height of the css class  ".topPanel.full-height"
// document.getElementById("indexPage_topPanel").style.height = window.innerHeight;
// console.log(window.innerHeight);


// I check if my PHP pieces of html inclusions load the script more than once : 
                                        console.log("mainPage.js Loaded");


// I temporary display the width of the browser to work on media queries :  (TO REMOVE !!!)
function inctrustePixels(){
    var browser_width = document.documentElement.clientWidth;

    document.getElementById("incrustation_pixels").innerText = browser_width + "px";
}

// var incrustation_pixels_array = document.getElementsByClassName("incrustation_pixels");
// console.log(incrustation_pixels_array);

// Displaying the size in pixels when resizing window : 
window.addEventListener(onresize, inctrustePixels() ); // doesn't work. 

inctrustePixels();