<div class="Member-imgList">
	<?php foreach ($members as $oMember)
	{
		echo '
			<div class="Member-imgList-img">
				<img
				data-id="' . $oMember->getId() . '"
				alt="Photo de ' . $oMember->getName() . '"
			     src="' . DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_MEMBER . DIRECTORY_SEPARATOR . $oMember->getPicture() . '
		     		">
		     </div>
		     
		     <div style="max-width: 749px" class="Members-info-mobile" data-id="' . $oMember->getId() . '">
		     		'; include '_member.php'; echo'
			</div>
		 
		';
		
	};
	?>
</div>

<div style="min-width: 750px;" class="Members-info-desktop">
	<?php foreach ($members as $oMember)
	{
		include '_member.php';
	};
	?>
</div>

