import {switchMainSecondaryPicture} from "./functions.js";

const container = document.querySelector('#sliderProduct');
const pageName = 'home';
let index = 1;
let maxIndex = container.getAttribute('data-limit');

function updateSlider() {
    index ++;
    callAjaxSlider();

    // Si index atteint le nbre de produits contenus en BDD,
    // alors on remet à 0 le compteur
    if(index >= maxIndex){
        index = 0;
    }

}

/**
 * Mettre à jour le slider des produits
 */
function callAjaxSlider() {

    const formData = new FormData();
    formData.append('context','ajax_slider_products');
    formData.append('index',index.toString());
    formData.append('page', pageName);

    fetch('ajax.php',{
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            container.innerHTML = data;
            // switchMainSecondaryPicture();

            // Ajouter la classe CSS pour la transition
            container.classList.add('card-transition');

            // Supprimer la classe CSS après un court délai
            setTimeout(() => {
                container.classList.remove('card-transition');
            }, 1000);
        });

}

// TODO Changer le pathname avant hébergement
if (window.location.pathname === '/LEPAINDELATERRE_site/' || window.location.search === '?page=home')
{
    // Appeler callAjaxSlider une première fois au chargement du DOM
    callAjaxSlider();

    setInterval(updateSlider, 4000);
}