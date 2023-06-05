<?php foreach ($members as $oMember)
{
	include '_member.php';
};
?>

<div class="Member-imgList">
	<?php foreach ($members as $oMember)
	{
		echo '

			<img
			class="Member-imgList-img"
			data-id="' . $oMember->getId() . '"
			alt="Photo de ' . $oMember->getName() . '"
		     src="' . DIR_UPLOADS . DIRECTORY_SEPARATOR . DIR_MEMBER . DIRECTORY_SEPARATOR . $oMember->getPicture() . '">

		';
		
	};
	?>
</div>
