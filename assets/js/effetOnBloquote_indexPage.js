//* EFFECT ON BLOQUOTE (INDEX PAGE) USING LIBRAIRIE TYPEWRITER.
/* FOR MORE INFORMATION PLEASE VISIT : 
    https://safi.me.uk/typewriterjs/
*/

// get HTMLelement
const bloquoteOnIndexPage_node = document.getElementById('bigquote_on_index_page');

const speedTyping_ms = 100; // millisecond between each keys
const standardWaitingDelay = 800;

var typewriter_onBloquote = new Typewriter(bloquoteOnIndexPage_node, {
    loop: false, // if `true` , at the end the text will be erased backward, then write again.
    delay: speedTyping_ms
});

typewriter_onBloquote
    // .typeString(textForBloquote)
    .typeString("Étrange.")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>Comme tout l’est.")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>Comme Nous sommes.")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>Toujours à deux doigts de vivre vraiment")
    .pauseFor(80)
    .typeString(".")
    .pauseFor(80)
    .typeString(".")
    .pauseFor(80)
    .typeString(".")
    .pauseFor(standardWaitingDelay)
    .typeString(" Avec vous.")
    .pauseFor(standardWaitingDelay)
    .typeString(" Avec Nous. Avec soi-même.")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>Nous sommes nos chers inc")
    .pauseFor(1000)
    .deleteChars(9)
    .pauseFor(400)
    .typeString("chairs inconnues,")
    .pauseFor(standardWaitingDelay)
    .typeString(" nous sommes  « l’autrement »,")
    .pauseFor(standardWaitingDelay)
    .typeString(" l’exception aux règles, ")
    .pauseFor(standardWaitingDelay)
    .typeString("ce que le bruit de vivre est au silence de nos solitudes,")
    .pauseFor(standardWaitingDelay)
    .typeString(" ce que la destination est au chemin,")
    .pauseFor(standardWaitingDelay)
    .typeString(" quand l’arrivée se dessine enfin, au loin.")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>À la fois le commencement,")
    .pauseFor(standardWaitingDelay)
    .typeString(" et à la fois la fin d’une nouvelle idée.")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>")
    .pauseFor(standardWaitingDelay)
    .typeString("<br>")
    .pauseFor(standardWaitingDelay)
    .typeString("L’Alinéa a tout ça")
    .pauseFor(300)
    .typeString(" .")
    .pauseFor(300)
    .typeString(" .")
    .pauseFor(300)
    .typeString(" .")
    .pauseFor(5000)
    .deleteAll()
    /* .pauseFor(2500)
    .typeString('Strings can be removed')
    .pauseFor(2500)
    .deleteChars(7)
    .typeString('<strong>altered!</strong>')
    .pauseFor(2500) */
    .start();