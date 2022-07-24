<h3 class="dashboard-section-title"><?= $GLOBALS['entityClassname']::$entityNameSingular ?></h3>
<?php if (($action === 'formEditEntity' || $action === 'formNewEntity') && (isset($GLOBALS['entityInstance'])) ): ?>
	<?php
		// TEST : récupérer les fields de entityClassname (ici concert) , sauf certains
			// TODO : avoir une fonction qui récupère les fields
			// TODO : avoir une liste d'exclusion dans la classe

			$entityInstance = $GLOBALS['entityInstance']; // TODO plus tard utiliser les noms de tables et de classe de maniere dynamique

			$fieldsInfosFromDb = $entityInstance->fieldsInfosFromDb($mysqli);
			# var_dump($fieldsInfosFromDb); // DEBUG : car je voudrais un array de champs et leur type (à construire dans la classe)

			$fieldsInfosForForm_indArr = $entityInstance->fieldsInfosForForm($mysqli);
			# var_dump($fieldsInfosForForm_indArr); // DEBUG : car je voudrais un array de champs et leur type (à construire dans la classe)

			if ($action === 'formEditEntity')
			{
				$actionForController = 'updateEntity';
			} else if ($action === 'formNewEntity')
			{
				$actionForController = 'createEntity';
			}

	?>
	<div class="formdatabase-container">
		<form method="POST" action="/controller/controller_dashboard_form.php" class="formdatabase">
			<!-- hidden fields -->
			<input type="hidden" id="action" name="action" value="<?= $actionForController ?>">
			<input type="hidden" id="entityClassname" name="entityClassname" value="<?= $GLOBALS['entityClassname'] ?>">
			<!-- other fields -->
			<div class="formdatabase-fields" style="display:grid; grid-template-columns:fit-content(100%) 1fr; row-gap:.2rem; column-gap: 1rem;">
				<?php foreach ($fieldsInfosForForm_indArr as $indexFieldInfos => $fieldInfos): ?>
					<?php 
						//--- store the get_xxxxxxxx() string to use use dynamically as value for html input
						$valueOfTheField = '';
						if ($action === 'formEditEntity')
						{
							$getter_method_name = $fieldInfos['getter_method_name'];

							$valueOfTheField = $entityInstance->{$getter_method_name}() ?? 'le fieldName de entityInstance is NOT set';

							# if ( isset($entityInstance->{$fieldInfos['fieldName']}) /* && $entityInstance->{$fieldInfos['fieldName']} !== null */ )
							# {
							# 	$valueOfTheField = $entityInstance->{$getter_method_name}();
							# 	# $valueOfTheField = 'is_set_and_not_null';
							# } else 
							# {
							# 	$valueOfTheField = 'le fieldName de entityInstance is NOT set';
							# }
						}
					?>

					<div class="formdatabase-label-container" style="background-color: #516875; padding:.2rem .9rem;">
						<label class="formdatabase-label-text" for="<?= $fieldInfos['idAttribute'] ?>" ><?= $fieldInfos['fieldName'] ?></label>
					</div>
					<?php switch($fieldInfos['form_input_type']): ?><?php case 'textarea': ?>
							<textarea
								id="<?= $fieldInfos['idAttribute'] ?>"
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value=""
								style="resize: vertical;"
								rows="15"
								onclick="this.style.height = '';this.style.height = this.scrollHeight + 'px'"
								oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"
							><?= $valueOfTheField // $entityInstance->get_description() ?></textarea>
							<?php break ?>
						<?php case 'text': ?>
							<input 
								type="text" 
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								<?= ($fieldInfos['fieldName'] === 'rowid') ? 'readonly' : '' ?>
							/>
							<?php break ?>
						<?php case 'date': ?>
							<input 
								type="date"
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								min="2022-01-01"
								max="2040-12-31"
								<?= (in_array($fieldInfos['fieldName'] , ['date_creation','date_last_connection'])) ? 'readonly' : '' ?>
							/>
							<?php break ?>
						<?php case 'time': ?>
							<input 
								type="time"
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								min="05:00"
								max="23:00"
								<?= (in_array($fieldInfos['fieldName'] , ['date_creation','date_last_connection'])) ? 'readonly' : '' ?>
							/>
							<?php break ?>
					<?php endswitch; ?>
				<?php endforeach ?>
			</div>
			<div class="formdatabase-buttons">
				<!-- <a href="<#?= $_SERVER['PHP_SELF'].'?entityClassname='.$_GET['entityClassname'].'&rowidInModifyMode='.$entityRowFromDb['rowid'] ?>" class="btn-fit-outline-orange">Modifier</a> -->

				<a href="<?= $_SERVER['PHP_SELF'].'?entityClassname='.$GLOBALS['entityClassname'].'&action=showDashboardOfEntity' ?>" class="btn-fit-outline-orange">Revenir sans enregistrer</a>

				<input type="submit" id="" name="" class="btn-fit-outline-green" value="Enregistrer les changements">
			</div>
		</form>
	</div>
<?php endif ?>