import {switchDescRecipe} from "./functions.js";
import {switchMainSecondaryPicture} from "./functions.js";

// Au chargement de la page, placer un écouteur sur les Cards
// Au survol, afficher les ingrédients
switchDescRecipe();

// Au chargement de la page, placer un écouteur sur les Cards
// Au survol, afficher l'image secondaire (picture_secondary)
// switchMainSecondaryPicture();
//
// // Placer de nouveau l'écouteur lors du chargement du HTML avec ajax
// const containerAjax = document.getElementById('container-ajax');
// if(containerAjax){
//     containerAjax.addEventListener("click", function (e) {
//         let target = e.target;
//         if (target.classList.contains('.Cards')) {
//             i.switchDescRecipe();
//         }
//     });
// }


let filters = document.querySelectorAll('.Products-filter-link');

filters.forEach(elt => {
    elt.addEventListener('click', function () {
        let currentFilter = document.querySelector('.Products-filter-link.filtered');
        if (currentFilter) {
            console.log('currentFilter' + currentFilter);
            i.toggleClass(currentFilter,'filtered','unfiltered');
        }
        console.log('currentFilter' + currentFilter);
        console.log('elt' + elt);
        i.toggleClass(elt,'filtered','unfiltered');
    });
});


