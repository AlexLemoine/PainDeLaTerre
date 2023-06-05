// *** MISE EN FORME
// Si la largeur de l'écran est supérieure ou égale à 550px, affichez la première memberDiv

import {toggleClass} from "./functions.js";

const screenWidth = window.innerWidth;

if (screenWidth >= 550) {

    const firstMemberDiv = document.querySelector('.Member:first-of-type');
    const idFirstMemberDiv = firstMemberDiv.getAttribute('data-id');
    const imgFirstMemberDiv = document.querySelector(`.Member-imgList-img[data-id="${idFirstMemberDiv}"]`);

    firstMemberDiv.classList.remove('hidden');
    imgFirstMemberDiv.classList.add('selected');
}


// *** INTERACTION UTILISATEUR

// Sélectionnez toutes les images de la liste des membres
const memberImages = document.querySelectorAll('.Member-imgList-img');

// Parcourir chaque image et ajoutez un gestionnaire d'événements de clic
memberImages.forEach((image) => {
    image.addEventListener('click', () => {

        // Récupérez la valeur de l'attribut data-id de l'image cliquée
        const memberId = image.getAttribute('data-id');

        // Sélectionnez la div correspondante au membre en utilisant son attribut data-id
        const memberDiv = document.querySelector(`.Member[data-id="${memberId}"]`);

        // Ajouter la classe 'hidden' à celle qui n'en comporte pas
        // Enlever la classe underline de son img
        const memberSelected = document.querySelector('.Member:not(.hidden)');

        if(memberSelected){
            const idMemberSelected = memberSelected.getAttribute('data-id');
            const imgMemberSelected = document.querySelector(`.Member-imgList-img[data-id="${idMemberSelected}"]`);
            toggleClass(memberSelected,'hidden','visible');
            toggleClass(imgMemberSelected,'selected','unselected');
        }

        // Supprimez la classe "hidden" pour afficher la div du membre correspondant
        toggleClass(memberDiv,'hidden','visible');

        // Ajouter la classe "underline" à l'image cliquée
        toggleClass(image,'selected','unselected');

    });
});