//* ANIMATION ON PAGE 'HOME' ========================================================
window.addEventListener('scroll', function(event){
	
	// Position de la div social_media depuis le haut:
	var divSocialMedia_node = document.getElementById('socialMedia_id');

	if (divSocialMedia_node !== null) {
		let positionDivSocialMedia_nbr = divSocialMedia_node.offsetTop; // en largeur LG :  environ 1275px
			/* cette valeur signifie : pour que la div socialMedia se trouve en haut de la fenêtre*/
		//console.debug(`positionDivSocialMedia_nbr: ${positionDivSocialMedia_nbr}` ); // 🛑 DEBUG

	
		// position actuelle du scroll dans la page:
		let scrollPositionY = window.scrollY;
			//console.debug(`window.scrollY: ${window.scrollY}` ); // 🛑 DEBUG
		
		// detecter si on a scrollé au point d'afficher la divSocialMedia :
		/*
		- à 676px de scroll: debut d'apparition de la div socialMedia
		- a 947 de scroll: les 3 icones sont finies d'être affichées.
		*/

		var socialMediaIcons = Array.from(document.getElementsByClassName("socialMedia-link"));
			// console.log("socialMediaIcons"); // 🛑 DEBUG
			// console.log(socialMediaIcons); // 🛑 DEBUG

		if (scrollPositionY > 1020 ) {
			// console.info("PLAY ANIMATION"); // 🛑 DEBUG
			
			// var delayBeforeAppear = 300;
				// console.debug(socialMediaIcons); // 🛑 DEBUG
			socialMediaIcons.forEach( function(element) {
				//element.style.transitionDelay = delayBeforeAppear + 150;
					// console.debug(delayBeforeAppear) // 🛑 DEBUG
				element.classList.add("play-animation");
			});
			
		}

	}
}); 

// VOIR NOTION POUR CONTINUER : https://www.notion.so/j-essaye-de-faire-se-d-clencher-des-l-ments-lors-du-scroll-b682364901304fb8abd2da4ad4d719ba
// et VOIR CETTE PAGE : https://stackoverflow.com/questions/487073/how-to-check-if-element-is-visible-after-scrolling 