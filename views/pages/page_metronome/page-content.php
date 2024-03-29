<?php 
	# include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");
?>

<main>
	<h2 class="page-title">Metronome</h2>

	<?php 
		// --- html who display the message if there is a key in $_GET or $_COOKIE :
		include($_SERVER['DOCUMENT_ROOT']."/views/common/popup_message.php"); 
	?>

	<section class="metronome" id="metronome">
		<div class="metronome-tempo-container">
			<div class="metronome-tempo-header">
				<button class="metronome-tempo-start" id="metronome_tempo_start">Start</button>
				<button class="metronome-tempo-stop" id="metronome_tempo_stop">Stop</button>
			
				<label for="tempo" class="metronome-tempo-label">Tempo</label>
				
				<input type="text" value="120" id="metronome_tempo_input" class="metronome-tempo-input">
			</div>
			<!-- <p id="metronome_tempo_input">120</p> -->
		</div>
		<div class="metronome-pulse-container">
			<div class="metronome-pulse"><p>1</p></div>
			<div class="metronome-pulse"><p>2</p></div>
			<div class="metronome-pulse"><p>3</p></div>
			<div class="metronome-pulse"><p>4</p></div>
		</div>
	</section>
</main>