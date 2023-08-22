import {toggleClass} from "./functions.js";

// **** CONSTANTES DE PAGES
const AJAX_URL = 'ajax.php';
const CONTEXT_ADMIN_UPDATE_MEMBERS = 'admin_update_members';
const CONTEXT_ADMIN_MODIFY_MEMBER = 'admin_modify_members';
const CONTEXT_ADMIN_DELETE_MEMBERS = 'admin_delete_members';
const CONTEXT_ADMIN_CANCEL_MODIFICATION_MEMBERS = 'admin_cancel_modification_member';


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


function onClickCancelBtn() {

    // Récupération de l'élément qui contiendra les cartes à mettre à jour
    let targetCard = document.querySelector('.Members-list.modify');

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('.ModifyForm'));
    formData.append('context', CONTEXT_ADMIN_CANCEL_MODIFICATION_MEMBERS);
    formData.append('id',targetCard.getAttribute('data-id'));

    // Envoi de la requête pour mettre à jour les cartes
    fetch(AJAX_URL, {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            // Mise à jour des cartes avec les données reçues
            targetCard.innerHTML = data;
            toggleClass(targetCard,'modify','unmodified');

            // Remettre en place les écouteurs sur modify et delete buttons
            listenModifyDeleteBtns();
        })

}

function onClickSaveBtn() {
    // TODO - onClickSaveBtn



}

function listenCancelSaveBtns() {
    const cancelBtn = document.querySelector('.modify .Card-cancel');
    const saveBtn = document.querySelector('.modify .Card-save');

    // ANNULER LES MODIFICATIONS
    cancelBtn.addEventListener('click',onClickCancelBtn);

    // SAUVEGARDER LES MODIFICATIONS
    saveBtn.addEventListener('click',onClickSaveBtn);
}

function callModifyMemberAjax(targetCard) {
    // Création d'un nouvel objet FormData
    const formData = new FormData();
    formData.append('context', CONTEXT_ADMIN_MODIFY_MEMBER);

    const id = targetCard.getAttribute('data-id');
    console.log(id);
    formData.append('id',targetCard.getAttribute('data-id'));

    // envoi requête pour maj card
    fetch(AJAX_URL, {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            targetCard.innerHTML = data;
            listenCancelSaveBtns();
        })

}

function onClickModifyBtn() {
    let targetCard = this.parentNode;
    targetCard.setAttribute('data-form','modifying');

    // Ne permettre qu'une modification de card à la fois
    let modifyCard = document.querySelector('.modify');
    if(!modifyCard){
        toggleClass(targetCard,'modify','unmodified');
        callModifyMemberAjax(targetCard);
    }
}

function onClickDeleteBtn() {
    let targetCard = this.parentNode;

    let isToDelete = confirm('Souhaitez-vous supprimer ce membre ?');
    if(isToDelete === true) {

        // Création d'un nouvel objet FormData
        const formData = new FormData();
        formData.append('isToDelete','yes');
        formData.append('context', CONTEXT_ADMIN_DELETE_MEMBERS);
        const id = targetCard.getAttribute('data-id');
        console.log(id);
        formData.append('id',targetCard.getAttribute('data-id'));

        // envoi requête pour maj card
        fetch(AJAX_URL, {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                targetCard.remove();
            })
    }
}

function listenModifyDeleteBtns() {

    const modifyBtn = document.querySelectorAll('.Card-modify');
    const deleteBtn = document.querySelectorAll('.Card-delete');

    console.log(deleteBtn);

    // MODIFIER LES INFOS DU PARTENAIRE
    modifyBtn.forEach(elt=> {
        console.log('modify btn listened');
        elt.addEventListener('click',onClickModifyBtn);
    })

    // SUPPRIMER UN PARTENAIRE
    deleteBtn.forEach(elt=> {

        elt.addEventListener('click',onClickDeleteBtn);
    })

}

function callDisplayMembersAjax() {

    const membersList = document.querySelector('.container-ajax-member');

    const formData = new FormData();
    const context = membersList.getAttribute('data-context')
    formData.append('context', context);
    console.log(context);

    // Envoi de la requête pour mettre à jour les cartes
    fetch(AJAX_URL, {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            console.log('data' + data);
            // Mise à jour des cartes avec les données reçues
            membersList.innerHTML = data;

            console.log('modifyDeleteBtn TODO');
            listenModifyDeleteBtns();
        })

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
listenModifyDeleteBtns();

