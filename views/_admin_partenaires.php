<?php foreach ($partenaires as $oPartenaire) : ?>

	<div class="Card" data-id="<?= $oPartenaire->getId(); ?>">
		<?php include '_admin_partenaire.php'; ?>
	</div>

<?php endforeach; ?>
