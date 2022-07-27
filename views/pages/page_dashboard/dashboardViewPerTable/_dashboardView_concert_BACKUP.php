<h3 class="dashboard-section-title">Concerts</h3>

<!-- TEST 1 : affichage en table html -->

<?php foreach ($concertsRowsFromDb as $concertRowFromDb): ?>
	<?php 
		// if the looping row is the one with a rowid that button `modify` has been clicked, then we add attribute 'disabled'
		$attribute_disabled = ((int) $concertRowFromDb['rowid']) === ((int) $rowidInModifyMode ) ? '' : 'disabled';
	?>
	<br><hr><br>
	<div class="formdatabase-container">
		<form method="POST" action="" class="formdatabase">
			<div class="formdatabase-fields" style_avirer="display:grid; grid-template-columns:fit-content(100%) 1fr; row-gap:.2rem; column-gap: 1rem;">
				<?php foreach ($concertRowFromDb as $looping_fieldName => $looping_value): ?>
					<div class="formdatabase-label-container" style_avirer="background-color: #516875; padding:.2rem .9rem;">
						<label class="formdatabase-label-text" for="" ><?= $looping_fieldName?></label>
					</div>
					<?php if($looping_fieldName === 'description'): ?>
						<textarea
							id="" 
							name="" 
							value=""
							style_avirer="resize: vertical;"
							<?= ($looping_fieldName == 'rowid') ? 'disabled' : $attribute_disabled ?>					
						><?= $looping_value ?></textarea>
					<?php else: ?>
						<input 
							type="text" 
							id="" 
							name="" 
							value="<?= $looping_value ?>" 
							<?= ($looping_fieldName == 'rowid') ? 'disabled' : $attribute_disabled ?>
						/>
					<?php endif ?>
				<?php endforeach ?>
			</div>
			<div class="formdatabase-buttons">
				<a href="<?= $_SERVER['PHP_SELF'].'?entity='.$_GET['entity'].'&rowidInModifyMode='.$concertRowFromDb['rowid'] ?>" class="btn-fit-outline-orange">Modifier</a>

				<input type="submit" id="" name="" class="btn-fit-outline-green" value="Enregistrer">
			</div>
		</form>
	</div>
<?php endforeach ?>
	

<div class="datagrid">
</div>