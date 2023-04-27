
<tr  class="Table-body-row Partenaire">
	
	<td class="Partenaire-name"><?= $oPartenaire->getName(); ?></td>
	<td class="Partenaire-img">
		<img class="Card-imgBox-img" src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $oPartenaire->getPicture(); ?>"
		alt="<?= $oPartenaire->getName(); ?>">
	</td>
	<td class="Partenaire-localisation"><?= $oPartenaire->getLocalisation(); ?></td>
	<td class="Partenaire-supply"><?= $oPartenaire->getSupply(); ?></td>
	<td class="Partenaire-desc"><?= $oPartenaire->getDescription(); ?></td>
	<td class="Partenaire-modify">
		<img src="assets/img/modifyButton.svg" class="Card-modify" alt="modify button" title="Modifier" data-action="modify">
	</td>
	<td class="Partenaire-delete">
		<img src="assets/img/deleteButton.svg" class="Card-delete" alt="delete button" title="Supprimer" data-action="delete">
	</td>

</tr>




