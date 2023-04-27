<table class="Table">
	<thead class="Table-titles">
		<tr>
			<th class="Table-titles-title">Nom</th>
			<th class="Table-titles-title">Image</th>
			<th class="Table-titles-title">Localisation</th>
			<th class="Table-titles-title">Type de fourniture</th>
			<th class="Table-titles-title">Description</th>
		</tr>
	</thead>


	<tbody class="Table-body">

		<?php foreach ($partenaires as $oPartenaire) : ?>
		
			<?php include '_admin_partenaire.php'; ?>
		
		<?php endforeach; ?>

	</tbody>


</table>

