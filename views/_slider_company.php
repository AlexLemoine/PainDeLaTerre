<div class="CompanySlider-imgBox" data-index="<?= $index; ?>">
	<img src="<?= DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_SLIDER . DIRECTORY_SEPARATOR .$companySlider->getUrl(); ?>"
	     alt="<?= $companySlider->getLegend(); ?>"
	     class="CompanySlider-imgBox-img">
	<p class="CompanySlider-imgBox-legend"><?= $companySlider->getLegend(); ?></p>
</div>