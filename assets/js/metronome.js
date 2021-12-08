const metronome_section = document.getElementById("metronome");
//const metronome_tempo_input = parseInt(document.getElementById("metronome_tempo_input").value);
// console.log(metronome_tempo_input);

//const metronome_pulses_arr = document.querySelectorAll(".metronome-pulse");
const metronome_pulses_arr = Array.from(document.querySelectorAll(".metronome-pulse"));

var metronome = {
    button_start: document.getElementById("metronome_tempo_start")
    , button_stop: document.getElementById("metronome_tempo_stop")
    // , tempo: metronome_tempo_input
    , tempo_input: document.getElementById("metronome_tempo_input")
    , tempo: parseInt(document.getElementById("metronome_tempo_input").value)
    , ms_between_pulse: function(){
        return Math.floor(60 / this.tempo * 1000);
    }
    , activated_pulse_id: 0
    , enlightActivePulse: function() {
        // reset all pulse
        metronome_pulses_arr[0].style.background = "unset";
        metronome_pulses_arr[1].style.background = "unset";
        metronome_pulses_arr[2].style.background = "unset";
        metronome_pulses_arr[3].style.background = "unset";
        
        // activate requested pulse
        metronome_pulses_arr[this.activated_pulse_id].style.background = "white";
    }
    , active_next_pulse: function(id_active_pulse){
        this.activated_pulse_id++;
        if (this.activated_pulse_id == 4) this.activated_pulse_id = 0;
    }
    , tempoInterval : function(){
        this.tempoInterval_id = setInterval(
            // other pulses after delay :
            () => {
                this.active_next_pulse();
                this.enlightActivePulse();
            }
            , this.ms_between_pulse()
        )
    }
    
    , start : function() {
        // first pulse :
        console.info("METRONOME démarré")
        this.enlightActivePulse();
        this.tempoInterval();
    }
    , stop : function() {
        clearInterval(this.tempoInterval_id);
        console.info("METRONOME stoppé")
    }
};

metronome.button_start.addEventListener("click", (event)=>metronome.start() );

metronome.button_stop.addEventListener("click", (event)=>metronome.stop() );

metronome.tempo_input.addEventListener("focus", (event)=>metronome.stop());

metronome.tempo_input.addEventListener(
    "input", 
    (event)=>{
        // console.log(event);
        metronome.tempo = parseInt(document.getElementById("metronome_tempo_input").value);
    }
);


/* setTimeout(() => {
    metronome.stop();
}, 3000); */



