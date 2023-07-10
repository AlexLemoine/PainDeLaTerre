import {switchMainSecondaryPicture} from "./functions.js";


// **** MISE EN FORME DES FILTRES SELECTIONNES ****

let filters = document.querySelectorAll('.Products-filter-link');

filters.forEach(filter => {
    filter.addEventListener('click', function () {
        let activeFilter = document.querySelector('.Products-filter-link.filtered');
        if (activeFilter) {
            activeFilter.classList.remove('filtered');
        }
        filter.classList.add('filtered');
    });
});



// **** MISE A JOUR DE LA LISTE DES PRODUITS
// EN FONCTION DE LA CATEGORIE CIBLEE ****

// Récupération des filtres de catégories
const categoryLinks = document.querySelectorAll('#category a');

for (const link of categoryLinks)
{
    link.addEventListener("click", (e) => {

        const containerAjax = document.getElementById('container-ajax');

        e.preventDefault();

        fetch(link.href)
            .then(response => response.text())
            .then(data => {
                containerAjax.innerHTML=data;
                switchMainSecondaryPicture();
            });
    });
}


// **** AU CHARGEMENT DE LA PAGE ****

// placer un écouteur sur les Cards
// Au survol, afficher l'image secondaire (picture_secondary)
switchMainSecondaryPicture();

