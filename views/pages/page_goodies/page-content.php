<?php 
	include($_SERVER['DOCUMENT_ROOT']."/".'datas/allSongs_variables.php');
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/utility_functions.php");

?>

<main>
	<h2 class="page-title">Goodies</h2>
	
	<section class="products">
		<div class="products-grid">
			<div class="product-card">
				<?php 
					$folderName = 'hoodie-white';
					$fileNames = ['front'/* ,'back' */ ];
				?>
				<?php for($i = 0 ; $i < count($fileNames) ; $i++): ?>
					<img src="<?= '/assets/img/products/'.$folderName.'/'.$fileNames[$i].'.jpg';?>" alt="<?= $folderName?>">
				<?php endfor; ?>
				<p class="product-title">Veste à capuche</p>

			</div>
		</div>
	</section>
</main>