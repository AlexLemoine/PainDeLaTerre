import {switchDescRecipe, toggleClass, switchMainSecondaryPicture} from "./functions.js";

// Au chargement de la page, placer un écouteur sur les Cards
// Au survol, afficher les ingrédients
switchDescRecipe();

// Au chargement de la page, placer un écouteur sur les Cards
// Au survol, afficher l'image secondaire (picture_secondary)
switchMainSecondaryPicture();

let filters = document.querySelectorAll('.Products-filter-link');

filters.forEach(elt => {
    elt.addEventListener('click', function () {
        let currentFilter = document.querySelector('.Products-filter-link.filtered');
        if (currentFilter) {
            toggleClass(currentFilter,'filtered','unfiltered');
        }
        toggleClass(elt,'filtered','unfiltered');
    });
});


