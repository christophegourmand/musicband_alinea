<?php 
	//--- TEST : Photoexplorer
	require_once($_SERVER['DOCUMENT_ROOT'].'/datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/controller/Photosexplorer.php');

	//print_r($_SERVER); 
	$photosExplorer = new Photosexplorer($_SERVER['DOCUMENT_ROOT'].'/assets/img/photos/from-facebook/');
	$photosExplorer->scanBaseFolder();
?>

<main>
	<h2 class="page-title">DEBUG</h2>

	<section class="debug">
		<pre>
			<?php var_dump($photosExplorer->getScannedElements() ); ?>
		</pre>
	</section>
</main>