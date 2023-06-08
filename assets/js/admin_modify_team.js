import {toggleClass} from "./functions.js";

const createBtn = document.querySelector('#Members .Members-creation .Card-create-button');
const divForm = document.querySelector('#Members .Members-creation-form');

/**
 * Fonction appelée pour masquer le bouton et afficher le formulaire de création
 */
function onClickCreateBtn()
{
    // Ajouter la classe hidden au bouton de création
    // pour le masquer
    toggleClass(createBtn,'hidden','visible');

    // Enlever la classe hidden à la div qui contient le formulaire de création
    // pour le faire apparaître
    toggleClass(divForm,'hidden','visible');
}

createBtn.addEventListener('click',onClickCreateBtn);


