<nav class="ajax-pagination">
    <ul class="pagination">
        <li class="<?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="#!" data-page="<?php echo $currentPage -1; ?>">
                <i class="fa-sharp fa-solid fa-backward"></i>
            </a>
        </li>

        <?php
        // Calcul du nbre max de pages nécessaires
        $iNbPages = ceil($nb_results / $nb_results_per_page);

        // Afficher la pagination dans des <a> selon le nbre de pages max calculé
        for($i=1;$i<=$iNbPages;$i++): ?>

            <li class="<?= ($currentPage == $i) ? "active" : "" ?>">
                <a href="#!" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>

        <?php endfor;?>

        <li class="<?= ($currentPage == $iNbPages) ? "disabled" : "" ?>">
            <a href="#!" data-page="<?php echo $currentPage +1; ?>">
                <i class="fa-sharp fa-solid fa-forward"></i>
            </a>
        </li>
    </ul>
</nav>

