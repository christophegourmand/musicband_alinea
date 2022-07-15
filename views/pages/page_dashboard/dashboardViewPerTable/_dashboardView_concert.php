<h3 class="dashboard-section-title">Concerts</h3>

<div style="text-align: center; margin-bottom: .5rem;">
	<a 
		href="<?= $_SERVER['PHP_SELF'].'?entity='.$entity.'&action=formNewEntity' ?>" 
		class="btn-icon-link btn-icon-link--add"
	>
		<!-- <i class="fas fa-plus"></i> -->
		<i class="fas fa-plus-circle"></i>
	</a>
</div>

<table class="datatable">
	<thead class="">
		<tr class="">
			<th class="">id</th>
			<th class="">active</th>
			<th class="">date</th>
			<th class="">nom de la salle</th>
			<th class="">ville</th>
			<th class=""></th>
		</tr>
	</thead>
	<tbody class="">
		<?php foreach ($concertsInstances as $i => $concertInstance):?>
			<tr class="">
				<td class=""><?= $concertInstance->get_rowid() ?></th>
				<td class=""><?= $concertInstance->get_active() ?></th>
				<td class=""><?= $concertInstance->get_date() ?></th>
				<td class=""><?= $concertInstance->get_venue_name() ?></th>
				<td class=""><?= $concertInstance->get_city_name() ?></th>
				<td class="datatable-row-buttons">
					<a 
						href="<?= $_SERVER['PHP_SELF'].'?entity='.$entity.'&action=formEditEntity'.'&rowid='.$concertInstance->get_rowid() ?>" 
						class="btn-icon-link btn-icon-link--edit"
					>
						<i class="fas fa-edit"></i>
					</a>
					<a href="#" class="btn-icon-link btn-icon-link--delete">
						<!-- <i class="fas fa-minus-circle"></i> -->
						<i class="fas fa-trash-alt"></i>
					</a>
				</th>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

