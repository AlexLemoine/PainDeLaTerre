<?php use Pdlt\Model\Product;

foreach ($products as $oProduct) : ?>

	<div class="Card" data-id="<?= $oProduct->getId(); ?>">
		<?php include '_admin_product.php'; ?>
	</div>

<?php endforeach; ?>