// Sound Generator using Javasctipt ========================================================

//
/* RESSOURCES for AudioContect and Oscilattor :
    https://developer.mozilla.org/en-US/docs/Web/API/Web_Audio_API

    https://developer.mozilla.org/en-US/docs/Web/API/AudioContext

    https://developer.mozilla.org/en-US/docs/Web/API/OscillatorNode 

    https://developer.mozilla.org/en-US/docs/Web/API/AudioNode

    https://marcgg.com/blog/2016/11/01/javascript-audio/
*/

// creattion d'un module 'contexte' (comme une sortie audio)
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext1 = new AudioContext();

// le module 'contexte' a besoin d'être créé 1 seule fois, MAIS un oscillateur a besoin d'être créé à chaque utilisation.

function bip (duration_sec) {
    // creation d'un module 'oscillateur'
    var oscillatorNode = audioContext1.createOscillator();
    oscillatorNode.type = "square";
    oscillatorNode.frequency.value = 440;

    // creation d'un module 'gain'  (comme un boitier de volume)
    var gainNode = audioContext1.createGain();

    // on connecte le module 'oscillateur' au module 'gain'
    oscillatorNode.connect(gainNode);

    // on connect le module 'gain' au module 'contexte->destination' (un puet comme envoyer aux speakers)
    gainNode.connect(audioContext1.destination);

    oscillatorNode.start(0);
    oscillatorNode.stop(audioContext1.currentTime + duration_sec );
}

//  var finish = audioContext1.destination;




// const metronome_section = document.getElementById("metronome_html"); // NEVER USED

const metronome_pulses_arr = Array.from(document.querySelectorAll(".metronome-pulse"));

// object 'metronome' ========================================================
var metronome = {
    // ----------------------------------- 
    // AUDIO

    sound: new Audio("../../assets/sound/yamaha_rx5_bd_02_128kbps.mp3")
    
    // ----------------------------------- 
    // STORE ELEMENTS FROM HTML

    , button_start: document.getElementById("metronome_tempo_start")
    , button_stop: document.getElementById("metronome_tempo_stop")
    , button_tempo_up: document.getElementById("metronome_tempo_up")
    , button_tempo_down: document.getElementById("metronome_tempo_down")
    , tempo_input: document.getElementById("metronome_tempo_input")
    
    // ----------------------------------- 
    // VARIABLES or PROPERTIES

    , tempo: parseInt(document.getElementById("metronome_tempo_input").value)
    , delay: 1000  // will be updated using function 'updateDelayFromTempo()'
    , beat_count: 1
    , bar_count: 1 // ou mettre -2 si je veux un precount
    , activated_pulse_id: 0

    // ----------------------------------- 
    // METHODS FOR TEMPO
    , updateDelayFromTempo: function(){
        this.delay = Math.floor(60 / this.tempo * 1000);
    }

    , increaseTempo: function(){
        this.tempo++;
        this.updateTempoInHtml();
        this.updateDelayFromTempo(); // used to update the delay between pulse.
    }
    
    , decreaseTempo: function(){
        this.tempo--;
        this.updateTempoInHtml();
        this.updateDelayFromTempo(); // used to update the delay between pulse.
    }

    , updateTempoInHtml:  function () {
        document.getElementById("metronome_tempo_input").value = String(this.tempo);
    }

    // ----------------------------------- 
    // METHODS FOR PULSES
    , turnOffAllPulses: function(){
        // reset all pulse
        metronome_pulses_arr[0].classList.remove('active');
        metronome_pulses_arr[1].classList.remove('active');
        metronome_pulses_arr[2].classList.remove('active');
        metronome_pulses_arr[3].classList.remove('active');
    }
     
    , turnOnActivePulse: function() {
        // V1 if active pulse is 0 again, reset all pulses style before re-apply to the first
            // if(this.activated_pulse_id == 0) this.turnOffAllPulses();

        // activate requested pulse
        metronome_pulses_arr[this.activated_pulse_id].classList.add('active');
    }

    , turnOffActivePulse: function() {
        // DE-activate requested pulse
        metronome_pulses_arr[this.activated_pulse_id].classList.remove('active');
    }

    , activeNextPulse: function(id_active_pulse){
        this.activated_pulse_id++;
        if (this.activated_pulse_id == 4) this.activated_pulse_id = 0;
    }

    // ----------------------------------- 
    // METHODS FOR 'BEATS' AND 'BARS'

    , increaseBeatCount:  function () {
        this.beat_count++;
        
        if((this.beat_count-1) % 4 === 0) {
            this.increaseBarCount();
            this.updateBarCountInHtml();
        }
    }
    , increaseBarCount:  function () {
        this.bar_count++;

        // pour le precount depuis -2 , on saute la mesure 0 qui n'existe pas en musique.
        if(this.bar_count == 0) this.bar_count = 1;
    }
    , updateBeatCountInHtml:  function () {
        // V1
        document.getElementById("metronome_beats_count").innerText = String(this.beat_count);

        // V2
        // let beat_count_formatted = 4 % (this.beat_count - 1);

        // document.getElementById("metronome_beats_count").innerText = String(beat_count_formatted);
    }
    , updateBarCountInHtml:  function () {
        document.getElementById("metronome_bars_count").innerText = String(this.bar_count);
    }

    // ----------------------------------- 
    // METHODS TO RUN 

    , run_continueAtIntervals : function(){
        this.tempoInterval_id = setInterval(
            // other pulses after delay :
            () => {
                this.sound.play();         // 🔊🔊
                // bip(0.05)         // 🔊🔊

                this.turnOffActivePulse();
                this.activeNextPulse();
                this.turnOnActivePulse();

                this.increaseBeatCount(); // this method will increase 'bar' (in object and in html)
                this.updateBeatCountInHtml();

                this.updateDelayFromTempo();
            }
            , this.delay
        )
    }
    
    , start : function() {
        // ==============================
        // INITIALISATION 

        // update in object ---------
        this.updateDelayFromTempo();
        this.beat_count = 1;
        this.bar_count = 1;
        
        // update in html ---------
        this.turnOffAllPulses();
        this.updateBeatCountInHtml();
        this.updateBarCountInHtml();
        
        // ==============================
        // FIRST PULSE
        this.sound.play(); // for the first 'beat'  🔊🔊
        // bip(0.05)         // 🔊🔊
        
        this.turnOnActivePulse(); // for the first 'beat'
        
        // FOLLOWING PULSES :
        this.run_continueAtIntervals(); // will regularly (on tempo) call 'turnOnActivePulse()' who will also play sound
    }

    , stop : function() {
        clearInterval(this.tempoInterval_id);
        this.activated_pulse_id = 0; // rebout to first pulse.
    }

    
}; // end of object 'metronome' ========================================================


// ====================================================
// EVENT LISTENERS ON BUTTONS
metronome.button_start.addEventListener(
    "click", 
    (event)=> {
        metronome.start();
    }
);

metronome.button_stop.addEventListener(
    "click", 
    (event)=> {
        metronome.stop();
    }
);

metronome.button_tempo_up.addEventListener(
    "click", 
    (event)=> {
        metronome.increaseTempo();
        metronome.stop(); // OPTIONNAL ?
        metronome.start();
    }
);

metronome.button_tempo_down.addEventListener(
    "click", 
    (event)=> {
        metronome.decreaseTempo();
        metronome.stop(); // OPTIONNAL ?
        metronome.start();
    }
);

// metronome.tempo_input.addEventListener("focus", (event)=>metronome.stop());  /OPTIONNAL ?

metronome.tempo_input.addEventListener(
    "focusout",  
    (event)=>{
        // console.log(event);
        metronome.tempo = parseInt(document.getElementById("metronome_tempo_input").value);
        metronome.updateDelayFromTempo(); // used to update the delay between pulse.
        metronome.stop(); // OPTIONNAL ?
        metronome.start();
    }
);

// ###############################
// add same 'event listeners' , but fot 'touch' on mobile :

metronome.button_start.addEventListener(
    "touch", 
    (event)=> {
        metronome.start();
    }
);

metronome.button_stop.addEventListener(
    "touch", 
    (event)=> {
        metronome.stop();
    }
);

metronome.button_tempo_up.addEventListener(
    "touch", 
    (event)=> {
        metronome.increaseTempo();
        metronome.stop(); // OPTIONNAL ?
        metronome.start();
    }
);

metronome.button_tempo_down.addEventListener(
    "touch", 
    (event)=> {
        metronome.decreaseTempo();
        metronome.stop(); // OPTIONNAL ?
        metronome.start();
    }
);

// metronome.tempo_input.addEventListener("focus", (event)=>metronome.stop());  /OPTIONNAL ?

metronome.tempo_input.addEventListener(
    "focusout",  
    (event)=>{
        // console.log(event);
        metronome.tempo = parseInt(document.getElementById("metronome_tempo_input").value);
        metronome.updateDelayFromTempo(); // used to update the delay between pulse.
        metronome.stop(); // OPTIONNAL ?
        metronome.start();
    }
);
