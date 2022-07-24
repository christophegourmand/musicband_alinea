<h3 class="dashboard-section-title"> <?= $GLOBALS['entityClassname']::$entityNamePlural ?> </h3>

<div style="text-align: center; margin-bottom: .5rem;">
	<a 
		href="<?= $_SERVER['PHP_SELF'].'?entityClassname='.$GLOBALS['entityClassname'].'&action=formNewEntity' ?>" 
		class="btn-icon-link btn-icon-link--add"
	>
		<!-- <i class="fas fa-plus"></i> -->
		<i class="fas fa-plus-circle"></i>
	</a>
</div>

<table class="datatable">
	<thead class="">
		<tr class="">
			<?php foreach ($GLOBALS['entityClassname']::$fieldsToPrintInDashboard as $i => $field_assocArr): ?>
				<th class=""><?= $field_assocArr['fieldnameInHtml'] ?></th>
			<?php endforeach ?>
			<th class=""></th><!-- this column is for icons `modify`, `delete` -->
		</tr>
	</thead>
	<tbody class="">
		<?php foreach ($GLOBALS['entityInstances'] as $i => $entityInstance):?>
			<tr class="">
				<!-- VALUES OF FIELDS: -->
				<?php foreach ($GLOBALS['entityClassname']::$fieldsToPrintInDashboard as $i => $field_assocArr): ?>
					<?php $methodGetForThisField = 'get_'.$field_assocArr['fieldnameInSql'] ?>
					<td class=""><?= $entityInstance->$methodGetForThisField() ?></td>
				<?php endforeach ?>

				<!-- BUTTONS `modify` , `delete` : -->
				<td class="datatable-row-buttons">
					<a 
						href="<?= $_SERVER['PHP_SELF'].'?entityClassname='.$GLOBALS['entityClassname'].'&action=formEditEntity'.'&rowid='.$entityInstance->get_rowid() ?>" 
						class="btn-icon-link btn-icon-link--edit"
					>
						<i class="fas fa-edit"></i>
					</a>
					<a 
						href="<?= '/controller/controller_dashboard_delete_entity.php'.'?entityClassname='.$GLOBALS['entityClassname'].'&action=deleteEntity'.'&rowid='.$entityInstance->get_rowid() ?> "
						class="btn-icon-link btn-icon-link--delete"
					>
						<!-- <i class="fas fa-minus-circle"></i> -->
						<i class="fas fa-trash-alt"></i>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

