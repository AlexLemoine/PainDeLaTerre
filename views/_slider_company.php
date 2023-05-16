<div class="CompanySlider-imgBox" data-index="<?= $i; ?>">
	<img src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_SLIDER . DIRECTORY_SEPARATOR . $sliders[$i]->getUrl(); ?>"
	     alt="<?= $sliders[$i]->getLegend(); ?>"
	     class="CompanySlider-imgBox-img">
	<p class="CompanySlider-imgBox-legend"><?= $sliders[$i]->getLegend(); ?></p>
</div>