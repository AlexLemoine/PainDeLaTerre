<figure data-id="<?php echo $item->getId(); ?>"
	  class="Presentation-sliderCompany-imgBox">
	<img class="Presentation-sliderCompany-imgBox-img"
	     src="<?php echo DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_SLIDER . DIRECTORY_SEPARATOR . $item->getUrl(); ?>"
	     alt="<?php echo $item->getLegend(); ?>">
	<figcaption><?php echo $item->getLegend(); ?></figcaption>
</figure>