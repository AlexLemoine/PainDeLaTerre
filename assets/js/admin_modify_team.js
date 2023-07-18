import {toggleClass} from "./functions.js";

// **** CONSTANTES DE PAGES
const AJAX_URL = 'ajax.php';
const CONTEXT_ADMIN_UPDATE_MEMBERS = 'admin_update_members';


// **** CREATION D'UN MEMBRE

const createBtn = document.querySelector('#Members .Members-creation .Card-create-button');
const divForm = document.querySelector('#Members .Members-creation-form');


/**
 * Fonction appelée pour masquer le bouton et afficher le formulaire de création
 */
function onClickCreateBtn()
{
    // Ajouter la classe hidden au bouton de création
    // pour le masquer
    createBtn.classList.add('hidden');

    // Enlever la classe hidden à la div qui contient le formulaire de création
    // pour le faire apparaître
    divForm.classList.remove('hidden');

    // en cas d'annulation de création
    const cancelBtn = document.querySelector('#Members .Members-creation-form .Card-cancel');
    console.log('cancelBtn' + cancelBtn);

    cancelBtn.addEventListener('click',function (){

        const form = document.querySelector('#Members .Members-creation-form .ModifyForm');
        form.reset();

        // Ajouter la classe hidden au bouton de création
        // pour le masquer
        createBtn.classList.remove('hidden');

        // Enlever la classe hidden à la div qui contient le formulaire de création
        // pour le faire apparaître
        divForm.classList.add('hidden');
    })

}

function callDisplayMembersAjax() {




}

function callCreateMemberAjax() {

    // Création d'un FormData
    const formData = new FormData(document.querySelector('#Members .Members-creation-form .ModifyForm'));
    formData.append('context', CONTEXT_ADMIN_UPDATE_MEMBERS);
    console.log(formData);

    // Envoi de la requête pour créer le partenaire
    // Récupération des données du formulaire en POST
    fetch(AJAX_URL, {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            // Mise à jour du listing des membres
            callDisplayMembersAjax();

            const form = document.querySelector('#Members .Members-creation-form .ModifyForm');
            form.reset();

            // Ajouter la classe hidden au bouton de création
            // pour le masquer
            createBtn.classList.remove('hidden');

            // Enlever la classe hidden à la div qui contient le formulaire de création
            // pour le faire apparaître
            divForm.classList.add('hidden');

        })

}

function listenCreateBtn() {
    createBtn.addEventListener('click',onClickCreateBtn);

    // Appel AJAX en cas de création d'un membre
    const saveBtn = document.querySelector('#Members .Members-creation-form .ModifyForm .Card-save');
    saveBtn.addEventListener('click',callCreateMemberAjax);

}




// **** APRES CHARGEMENT DE LA PAGE

listenCreateBtn();

