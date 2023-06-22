// *** MENU BURGER ***
import {toggleClass} from "./functions.js";

const burgerMenu = document.querySelector('div.Header-menu-burger');
const burgerMenuLinks = document.querySelector('nav.Header-menu-links');

burgerMenu.addEventListener('click', function() {
    toggleClass(burgerMenu,'opened','closed');
    toggleClass(burgerMenuLinks,'opened','closed');
});


// *** BOUTON HAUT DE PAGE ***
// Récupérer l'élément <main>
const mainElement = document.querySelector('main');

// Calculer la hauteur du <main>
const mainHeight = mainElement.offsetHeight;

// Calculer le point de déclenchement (20% de la hauteur du <main>)
const triggerHeight = mainHeight * 0.2;

// Fonction pour afficher ou masquer le bouton en fonction de la position de défilement
function toggleBackToTopButton() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > triggerHeight) {
        // Afficher le bouton "Haut de page"
        document.querySelector('.layout.MainContent-topBack').style.display = 'block';
    } else {
        // Masquer le bouton "Haut de page"
        document.querySelector('.layout.MainContent-topBack').style.display = 'none';
    }
}

// Écouter l'événement de défilement
window.addEventListener('scroll', toggleBackToTopButton);