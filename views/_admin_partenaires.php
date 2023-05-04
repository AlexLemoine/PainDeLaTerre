<table class="Table" data-context="admin_company">
	<thead class="Table-titles">
		<tr>
			<th class="Table-titles-title">Nom</th>
			<th class="Table-titles-title">Image</th>
			<th class="Table-titles-title">Localisation</th>
			<th class="Table-titles-title">Type de fourniture</th>
			<th class="Table-titles-title">Description</th>
			<th class="Table-titles-title">Site</th>
		</tr>
	</thead>
	
	<tbody class="Table-body" data-context="admin_company">

		<?php foreach ($partenaires as $oPartenaire) : ?>
		
			<?php include '_admin_partenaire.php'; ?>
		
		<?php endforeach; ?>

	</tbody>
	
</table>

