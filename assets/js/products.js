import * as i from './functions.js';

// Au chargement de la page, placer un écouteur sur les Cards
i.listenCards();

// Placer de nouveau l'écouteur lors du chargement du HTML avec ajax
const containerAjax = document.getElementById('container-ajax');
containerAjax.addEventListener("click", function (e) {
    let target = e.target;
    if (target.classList.contains('.Cards')) {
        i.listenCards();
    }
});


let filters = document.querySelectorAll('.Products-filter-link');

filters.forEach(elt => {
    elt.addEventListener('click', function () {
        let currentFilter = document.querySelector('.Products-filter-link.filtered');
        if (currentFilter) {
            i.toggleClassFiltered(currentFilter);
        }
        i.toggleClassFiltered(elt);
    });
});
