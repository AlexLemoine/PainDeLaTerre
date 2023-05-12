import {switchMainSecondaryPicture} from "./functions.js";

const container = document.querySelector('#sliderProduct');
let index = 1;
let maxIndex = container.getAttribute('data-limit');

function updateSlider() {
    index ++;
    console.log(index);
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

    fetch('ajax.php',{
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            container.innerHTML = data;
            switchMainSecondaryPicture();
    });

}



if (window.location.pathname === '/LEPAINDELATERRE_site/' || window.location.search === '?page=home')
{
    // Appeler callAjaxSlider une première fois au chargement du DOM
    callAjaxSlider();

    setInterval(updateSlider, 4000);
}