<!--Pour vue home du slider de Produits-->

<?php foreach ($oProduct as $product): ?>
<div class="Card">

	<figure class="Card-imgBox">
		
		<img id="img1"
		     class="Card-imgBox-img"
		     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $product->getPicture(); ?>"
		     alt="<?= $product->getName(); ?>">
		
		<img id="img2"
		     class="Card-imgBox-img hidden"
		     src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . $product->getPictureSecondary(); ?>"
		     alt="<?= $product->getName(); ?>">
		
	</figure>
	
	<?php if(isset($page) && $page !== PAGE_HOME): ?>
		<h2 class="Card-title"><?= $product->getName(); ?></h2>
		
		<section class="Card-desc">
			<p class="Card-desc-text"><?= $product->getDescription(); ?></p>
			<p class="Card-desc-frequency"><?= 'Disponible ' . $product->getFrequency()->getDesignation(); ?></p>
		</section>
		
		<section class="Card-recipe">
			<h3 class="Card-recipe-title">Ingrédients</h3>
			<p class="Card-recipe-text"><?= $product->getIngredients(); ?></p>
		</section>
	<?php endif; ?>
	
</div>
<?php endforeach; ?>



