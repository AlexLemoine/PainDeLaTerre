<header class="Header">

        <div class="Header-logo">
            <picture class="Header-logo-img">
                <source srcset="assets/img/logoBlancHorizontal.png" media="(min-width: 550px)">
                <img src="assets/img/logoBlanc.png" alt="logo pain">
            </picture>
        </div>
        <div class="Header-menu">
            <div class="Header-menu-burger">
                <img class="Header-menu-burger-img" src="assets/img/logoPainBlanc.svg" alt="logo pain blanc">
                <p class="Header-menu-burger-title">Menu</p>
            </div>
            <nav class="Header-menu-links">
                <a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_HOME) ? 'selected' : '' ?>"
                   href="?page=<?php echo PAGE_HOME; ?>"><?= TITLE_HOME ?></a>
                <a class="Header-menu-links-link <?= (isset($_GET['page']) && $_GET['page'] === PAGE_PRODUCTS) ? 'selected' : '' ?>"
                   href="?page=<?php echo PAGE_PRODUCTS; ?>"><?= TITLE_PRODUCTS ?></a>
                <a class="Header-menu-links-link" href="#">Actualités</a>
                <a class="Header-menu-links-link" href="#">Contact</a>
            </nav>
        </div>

</header>

