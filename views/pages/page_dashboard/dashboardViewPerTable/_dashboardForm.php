<h3 class="dashboard-section-title"><?= $GLOBALS['entityClassname']::$entityNameSingular ?></h3>
<?php if (($action === 'formEditEntity' || $action === 'formNewEntity') && (isset($GLOBALS['entityInstance'])) ): ?>
	<?php
		// TEST : récupérer les fields de entityClassname (ici concert) , sauf certains
			// TODO : avoir une fonction qui récupère les fields
			// TODO : avoir une liste d'exclusion dans la classe

			$entityInstance = $GLOBALS['entityInstance']; // TODO plus tard utiliser les noms de tables et de classe de maniere dynamique

			$fieldsInfosFromDb = $entityInstance->fieldsInfosFromDb($mysqli);
			# var_dump($fieldsInfosFromDb); // DEBUG : car je voudrais un array de champs et leur type (à construire dans la classe)

			// REVIEW : DEPRACATED
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
				<?php foreach ($entityInstance::$fieldsInfos as $key_fieldName => $fieldInfos): ?>
					<?php 
						//--- store the get_xxxxxxxx() string to use use dynamically as value for html input
						$valueOfTheField = '';

						if ($action === 'formEditEntity')
						{
							$getter_method_name = 'get_'.$key_fieldName;

							$valueOfTheField = $entityInstance->{$getter_method_name}() ?? 'le fieldName de entityInstance is NOT set'; // REVIEW : not sure that this line should exist (if yes, maybe a different way is better)
						}
					?>

					<div class="formdatabase-label-container" style="background-color: #516875; padding:.2rem .9rem;">
						<label class="formdatabase-label-text" for="<?= $fieldInfos['idAttribute'] ?>" ><?= $fieldInfos['fieldnameInHtml'] ?></label>
					</div>
					<?php switch($fieldInfos['htmlInputType']): ?><?php case 'textarea': ?>
							<textarea
								id="<?= $fieldInfos['idAttribute'] ?>"
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value=""
								style="resize: vertical;"
								rows="15"
								onclick="this.style.height = '';this.style.height = this.scrollHeight + 'px'"
								oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
							><?= $valueOfTheField ?></textarea>
							<?php break ?>
						<?php case 'number': ?>
							<?php 
								$attributes_min_and_max = '';
								if ($key_fieldName === 'active')
								{
									$attributes_min_and_max = 'min="0" max="1"';
								}
								// TODO : add a limit for foreign keys (ex: fk_group_id)
							?>
							<input 
								type="number"
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
								<?= $attributes_min_and_max ?>
							/>
							<?php break ?>
						<?php case 'text': ?>
							<input 
								type="text" 
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
							/>
							<?php break ?>
						<?php case 'password': ?>
							<input 
								type="password" 
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
							/>
							<?php break ?>
						<?php case 'email': ?>
							<input 
								type="email" 
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
							/>
							<?php break ?>
						<?php case 'url': ?>
							<input 
								type="url" 
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>" 
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
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
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
							/>
							<?php break ?>
						<?php case 'time': ?>
							<input 
								type="time"
								id="<?= $fieldInfos['idAttribute'] ?>" 
								name="<?= $fieldInfos['nameAttribute'] ?>" 
								value="<?= $valueOfTheField ?>"
								min="05:00:00"
								max="23:00:00"
								<?= ' '.$fieldInfos['attribute_required'].' '. $fieldInfos['attribute_readonly'] ?>
							/>
							<?php break ?>
					<?php endswitch; ?>
				<?php endforeach ?>
			</div>
			<div class="formdatabase-buttons">
				<a href="<?= $_SERVER['PHP_SELF'].'?entityClassname='.$GLOBALS['entityClassname'].'&action=showDashboardOfEntity' ?>" class="btn-fit-outline-orange">Revenir sans enregistrer</a>

				<input type="submit" id="" name="" class="btn-fit-outline-green" value="Enregistrer les changements">
			</div>
		</form>
	</div>
<?php endif ?>