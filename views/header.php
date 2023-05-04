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
			
			<?php //if($_SESSION['user']['role'] == ROLE_ADMIN): ?>
<!--				<div class="Admin-nav">-->
<!--					<a class="Header-menu-links-link --><?php //= (isset($_GET['page']) && $_GET['page'] === PAGE_ADMIN_PRODUCTS) ? 'selected' : '' ?><!--"-->
<!--					   href="?page=--><?php //echo PAGE_ADMIN_PRODUCTS; ?><!--">--><?php //= TITLE_ADMIN_PRODUCTS ?><!--</a>-->
<!--					<a class="Header-menu-links-link --><?php //= (isset($_GET['page']) && $_GET['page'] === PAGE_ADMIN_COMPANY) ? 'selected' : '' ?><!--"-->
<!--					   href="?page=--><?php //echo PAGE_ADMIN_COMPANY; ?><!--">--><?php //= TITLE_ADMIN_COMPANY ?><!--</a>-->
<!--				</div>-->
			<?php //else: ?>

			<a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_HOME) ? 'selected' : '' ?>"
			   href="?page=<?php echo PAGE_HOME; ?>"><?= TITLE_HOME ?></a>
			<a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_PRODUCTS) ? 'selected' : '' ?>"
			   href="?page=<?php echo PAGE_PRODUCTS; ?>"><?= TITLE_PRODUCTS ?></a>
			<a class="Header-menu-links-link" href="#">Actualités</a>
			<a class="Header-menu-links-link" href="#">Contact</a>
		</nav>
		<?php //endif; ?>
	</div>

</header>

