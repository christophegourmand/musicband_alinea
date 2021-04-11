
// ON 'MOBILE' MODE, DISPLAYING <MENUS PANEL> WHEN BUTTON IS CLICKED. 
    var menuToggler_node = document.getElementById("nav_toggler");

    var menusToShow_node = document.getElementById("nav_menus");

    menuToggler_node.addEventListener("click", function(){
        menusToShow_node.classList.toggle("show");    
    });


// ANIMATION ON PAGE 'CONTACT' ========================================================

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

// J'ESSAYE DE DETECTER LA POSITION DES ELEMENTS DANS LA PAGE:
    divSocialMedia_node = document.getElementById('socialMedia_id');

    console.log(divSocialMedia_node.offsetHeight); // en largeur LG :  environ 378px
    console.log(divSocialMedia_node.offsetTop); // en largeur LG :  environ 1275px  JE PENSE QUE C'EST CETTE VALEUR QUE JE VEUX !
    console.log(divSocialMedia_node.scrollHeight); // en largeur LG :  environ 378px
    
    // CONCLUSION : offsetHeight et scrollHeight indiquent TOUJOURS la même valeur !  (

    // VOIR NOTION POUR CONTINUER : https://www.notion.so/j-essaye-de-faire-se-d-clencher-des-l-ments-lors-du-scroll-b682364901304fb8abd2da4ad4d719ba
    // et VOIR CETTE PAGE : https://stackoverflow.com/questions/487073/how-to-check-if-element-is-visible-after-scrolling 
    