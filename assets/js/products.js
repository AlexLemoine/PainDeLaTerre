import {toggleClass, switchDescRecipe, switchMainSecondaryPicture} from "./functions.js";


// **** MISE EN FORME DES FILTRES SELECTIONNES ****

let filters = document.querySelectorAll('.Products-filter-link');

filters.forEach(filter => {
    filter.addEventListener('click', function () {
        let activeFilter = document.querySelector('.Products-filter-link.filtered');
        if (activeFilter) {
            toggleClass(activeFilter,'filtered','unfiltered');
        }
        toggleClass(filter,'filtered','unfiltered');
    });
});



// **** MISE A JOUR DE LA LISTE DES PRODUITS
// EN FONCTION DE LA CATEGORIE CIBLEE ****

// Récupération de l'élément select
const categoryLinks = document.querySelectorAll('#category a');

for (const link of categoryLinks)
{
    // Ajout d'un écouteur d'événements pour détecter les changements dans l'élément select
    link.addEventListener("click", (e) => {

        const containerAjax = document.getElementById('container-ajax');

        e.preventDefault();

        fetch(link.href)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                containerAjax.innerHTML=data;
                switchDescRecipe();
                switchMainSecondaryPicture();
            });

    });

}


// **** AU CHARGEMENT DE LA PAGE ****

// placer un écouteur sur les Cards
// Au survol, afficher les ingrédients
switchDescRecipe();

// placer un écouteur sur les Cards
// Au survol, afficher l'image secondaire (picture_secondary)
switchMainSecondaryPicture();