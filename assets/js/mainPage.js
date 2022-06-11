
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
			// console.debug(`👁‍🗨 visible_window_interior_size: ${visible_window_interior_size}`); // 🛑 DEBUG
		
	// (2) THEN OBTAIN NAVBAR SIZE.
	// (2) obtenir la taille de la barre de menu.
		// console.debug("👁‍🗨 élément DOM navToggler :"); // 🛑 DEBUG
		// console.debug(menuToggler_node); // console.dir affiche les triangles pour qu'on explore l'objet. // 🛑 DEBUG
	
	var menuTogglerSize_nbr = menuToggler_node.clientHeight;
		//console.debug(`👁‍🗨 menuTogglerSize_nbr : ${menuTogglerSize_nbr}`);
	
	// (3) THEN SET MENUS-SIZE
	// (3) en fonction de ça, définir la taille des menus en 'tuiles' pour qu'ils prennents la taille restante.
	var menusTiles_node = document.querySelector(".nav .nav-menus");

	if (window.innerWidth < 992 ) {
		if (ENV === 'dev') { 
			console.debug("📐 we are inferior than M, toggler button should be displayed.");
		}
		var menusTilesHeight_nbr = visible_window_interior_size - menuTogglerSize_nbr;
		var menusTilesHeight_str = `${menusTilesHeight_nbr}px`;
			// console.debug(`👁‍🗨 menusTilesHeight_str : ${menusTilesHeight_str}`); // 🛑 DEBUG
		menusTiles_node.style.height = menusTilesHeight_str;

	} else {
		menusTiles_node.style.height = "";
	}
	
	// (4) KEEP TRACK OF HOW MANY TIME THE RESIZE HAPPENED:
	var counterLabel = "COUNT OF RESIZE-EVENT";
	if (ENV === 'dev') { 
		console.count(counterLabel);
		console.info("✅ DONE: height of menus has been changed !");
	}

}

window.addEventListener("resize", setHeightForMenusTiles );

//* PREPARATION OF EFFECT 'PER STEPS ========================================================

// prepare array of 100 values from 0.0 to 1.0
arrayOfStepsValuesForBloquote = ()=> {
	let arrayOfSteps = [];
	for (let i=1; i<=100 ; i++){
		let value = i/100;
		arrayOfSteps.push(value);
	}
	return arrayOfSteps;
};
if (ENV === 'dev'){
	console.log(arrayOfStepsValuesForBloquote());
}   

//* ANIMATION ON PAGE 'CONTACT' ========================================================

var listOfSectionsContact_arr = Array.from( document.querySelectorAll(".contact") );

// console.log(listOfSectionsContact_arr[1]);
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
		console.log(eventSrollWhoIsHappening); // 🛑 DEBUG
		console.log(window.scrollY); // 🛑 DEBUG
	});
	*/
	// OK J'ARRIVE À SAVOIR QUELLE EST MA POSITION DE SCROLL DANS LA PAGE.
	// MAINTENANT JE DOIS RÉUSSIR À CONNAÎTRE LA POSITION DE L'ÉLÉMENT AVANT, ET CELUI APRÈS, L'ÉLÉMENT QUE JE VEUX ANIMER


function animateElementOnAppear(element_node, cssClassToAdd_str){

	if (element_node != null ) {
		var elementPositionTop = element_node.offsetTop;
		var elementHeight = element_node.offsetHeight;
		var elementPositionBottom = elementPositionTop + elementHeight;
	
		window.addEventListener('scroll', function(event){
			let scrollPositionY = window.scrollY;
			if (scrollPositionY > elementPositionBottom ) {
				element_node.classList.add(cssClassToAdd_str);
			}
		});
	}
}


/* SECTION: pour chaque vignette de chanson, récupère le chemin d'image dans la balise html et l'applique au css */

/*
 // TEST sur une seule card :
songCard_node = document.getElementById('musicsong_rowid_1');
pathToSongBackground = songCard_node.getAttribute('data-bg-img');
songCard_node.style.backgroundImage = `url("${pathToSongBackground}")`; 
*/

// NOTE , on a :  background-image: url(../img/photos/album_madison_backgrounds/madison_madison.jpg);

// NOTE , il faut : http://localhost/assets/img/photos/album_madison_backgrounds/madison_madison.jpg

// TEST sur plusieurs cards :
//--- récupère chaque card des chansons  (page_musiques et page_lyrics)

listOfSongCards_arr = document.querySelectorAll('.horizontalCard');

listOfSongCards_arr.forEach(songCard_node => {
	// console.log(songCard_node);
	pathToSongBackground = songCard_node.getAttribute('data-bg-img');
	// console.log(pathToSongBackground);
	songCard_node.style.backgroundImage = `url("${pathToSongBackground}")`;
});


