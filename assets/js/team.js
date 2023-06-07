// *** MISE EN FORME
// Si la largeur de l'écran est supérieure ou égale à 550px, affichez la première memberDiv

import {toggleClass} from "./functions.js";
//
const screenWidth = window.innerWidth;


let firstMemberDiv = document.querySelector('.Members-info-mobile');
if(screenWidth >= 750){
    firstMemberDiv = document.querySelector(`.Members-info-desktop`);
}
console.log(firstMemberDiv);

const idFirstMemberDiv = firstMemberDiv.getAttribute('data-id');
console.log(idFirstMemberDiv);

const imgFirstMemberDiv = document.querySelector(`.Member-imgList-img img[data-id="${idFirstMemberDiv}"]`);
console.log(imgFirstMemberDiv);

firstMemberDiv.classList.remove('hidden');
imgFirstMemberDiv.classList.add('selected');



// *** INTERACTION UTILISATEUR

// Sélectionnez toutes les div qui contiennent les images de la liste des membres
let memberImages = document.querySelectorAll('.Member-imgList-img img');

// Parcourir chaque image et ajoutez un gestionnaire d'événements de clic
memberImages.forEach((image) => {
    image.addEventListener('click', () => {

        // Récupérez la valeur de l'attribut data-id de l'image cliquée
        const memberId = image.getAttribute('data-id');

        // Sélectionnez la div correspondante au membre en utilisant son attribut data-id
        let memberDiv = document.querySelector(`.Members-info-mobile .Member[data-id="${memberId}"]`);
        if(screenWidth >= 750){
            memberDiv = document.querySelector(`.Members-info-desktop .Member[data-id="${memberId}"]`);
        }

        // Ajouter la classe 'hidden' à celle qui n'en comporte pas
        // Enlever la classe underline de son img
        const memberSelected = document.querySelector('.Member:not(.hidden)');

        if(memberSelected){
            const idMemberSelected = memberSelected.getAttribute('data-id');
            const imgMemberSelected = document.querySelector(`.Member-imgList-img img[data-id="${idMemberSelected}"]`);
            toggleClass(memberSelected,'hidden','visible');
            toggleClass(imgMemberSelected,'selected','unselected');
        }

        // Supprimez la classe "hidden" pour afficher la div du membre correspondant
        toggleClass(memberDiv,'hidden','visible');

        // Ajouter la classe "underline" à l'image cliquée
        toggleClass(image,'selected','unselected');

    });
});