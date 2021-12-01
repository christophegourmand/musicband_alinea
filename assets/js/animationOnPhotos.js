//* ANIMATION ON PHOTOS IN ALBUMS

const galleryImages_nodelist = Array.from(document.getElementsByClassName('gallery-img-link'));
// V1 :  using foreach >> FAIL
/* 
galleryImages_nodelist.forEach(
    element => {
        // console.debug("element");
        // console.debug(element);

        element.effectOnAppear(
            // param1: callback
            (received_node, entries)=>{
                received_node.classList.add("play-animation");
            },
            // param2: coeff of visibility (0 to 1)
            0.50
        )
    }
);

 */









/*
const divSocialMedia_node = document.getElementById('socialMedia_id');

divSocialMedia_node.effectOnAppear(
    // param1: callback
    (received_node, entries)=>{
        const socialMediaIcons_arr = Array.from(document.getElementsByClassName("socialMedia-link"));

        setTimeout( ()=>socialMediaIcons_arr[0].classList.add("play-animation"),100);
        setTimeout( ()=>socialMediaIcons_arr[1].classList.add("play-animation"),300);
        setTimeout( ()=>socialMediaIcons_arr[2].classList.add("play-animation"),600);
        
    },
    // param2: coeff of visibility (0 to 1)
    0.70
);

divSocialMedia_node.effectOnDisappear(
    (received_node, entries)=>{
        const socialMediaIcons_arr = Array.from(document.getElementsByClassName("socialMedia-link"));
        socialMediaIcons_arr.forEach( function(element) {
            element.classList.remove("play-animation");
        });
    },
    .8
);

*/