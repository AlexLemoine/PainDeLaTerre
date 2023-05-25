// *** MENU BURGER ***
function toggleClassOpened(element){
    element.classList.toggle('opened');
}

let burgerMenu = document.querySelector('div.Header-menu-burger');
let burgerMenuLinks = document.querySelector('nav.Header-menu-links');

burgerMenu.addEventListener('click', function() {
    toggleClassOpened(burgerMenu);
    toggleClassOpened(burgerMenuLinks);
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