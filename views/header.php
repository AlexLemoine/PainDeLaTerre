<header class="Header layout-back">

	<div class="Header-logo" onclick="window.location.href='?page=<?= PAGE_HOME; ?>'">
		<picture class="Header-logo-img">
			<source srcset="assets/img/logoBlancHorizontal.png" media="(min-width: 550px)">
			<img src="assets/img/logoBlanc.png" alt="logo pain de la terre">
		</picture>
	</div>
	<div class="Header-menu">
		<div class="Header-menu-burger">
			<img class="Header-menu-burger-img" src="assets/img/logoPainBlanc.svg" alt="logo pain blanc">
			<p class="Header-menu-burger-title">Menu</p>
		</div>


		<nav class="Header-menu-links">
			
<!--			--><?php //if($_SESSION['user']['role'] == ROLE_ADMIN): ?>
<!--				<div class="Admin-nav">-->
<!--					<a class="Header-menu-links-link --><?php //= (isset($_GET['page']) && $_GET['page'] === PAGE_ADMIN_PRODUCTS) ? 'selected' : '' ?><!--"-->
<!--					   href="?page=--><?php //echo PAGE_ADMIN_PRODUCTS; ?><!--">--><?php //= TITLE_ADMIN_PRODUCTS ?><!--</a>-->
<!--					<a class="Header-menu-links-link --><?php //= (isset($_GET['page']) && $_GET['page'] === PAGE_ADMIN_PARTENAIRES) ? 'selected' : '' ?><!--"-->
<!--					   href="?page=--><?php //echo PAGE_ADMIN_PARTENAIRES; ?><!--">--><?php //= TITLE_ADMIN_PARTENAIRES ?><!--</a>-->
<!--					<a class="Header-menu-links-link --><?php //= (isset($_GET['page']) && $_GET['page'] === PAGE_ADMIN_PRESENTATION) ? 'selected' : '' ?><!--"-->
<!--					   href="?page=--><?php //echo PAGE_ADMIN_PRESENTATION; ?><!--">--><?php //= TITLE_ADMIN_PRESENTATION ?><!--</a>-->
<!--					<a class="Header-menu-links-link --><?php //= (isset($_GET['page']) && $_GET['page'] === PAGE_ADMIN_TEAM) ? 'selected' : '' ?><!--"-->
<!--					   href="?page=--><?php //echo PAGE_ADMIN_TEAM; ?><!--">--><?php //= TITLE_ADMIN_TEAM ?><!--</a>-->
<!--				</div>-->
<!--			--><?php //else: ?>

			<a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_HOME) ? 'selected' : '' ?>"
			   href="?page=<?php echo PAGE_HOME; ?>"><?= TITLE_HOME ?></a>
			<a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_BOULANGERIE) ? 'selected' : '' ?>"
			   href="?page=<?php echo PAGE_BOULANGERIE; ?>"><?= TITLE_BOULANGERIE ?></a>
			<a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_TEAM) ? 'selected' : '' ?>"
			   href="?page=<?php echo PAGE_TEAM; ?>"><?= TITLE_TEAM ?></a>
			<a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_PRODUCTS) ? 'selected' : '' ?>"
			   href="?page=<?php echo PAGE_PRODUCTS; ?>"><?= TITLE_PRODUCTS ?></a>
			<a class="Header-menu-links-link" href="#">Notre démarche</a>
			<a class="Header-menu-links-link" href="#">Blog</a>
			<a class="Header-menu-links-link" href="#">Contact</a>
			
		</nav>
		<?php //endif; ?>
	</div>

</header>

