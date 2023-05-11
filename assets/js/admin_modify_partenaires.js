// Récupération du bouton de création
import {toggleClass} from "./functions.js";

const createBtn = document.querySelector('#admin_partenaires .Card-create');
// Récupération de l'élément qui contient le form de création
let formContainer = document.querySelector('#admin_partenaires .Card-create-form');


function onClickCreateBtn () {
    createBtn.classList.add('hidden');

    // Afficher le formulaire
    formContainer.classList.remove('hidden');

    const targetCancelBtn = document.querySelector('.Card-create-form .Card-cancel');
    targetCancelBtn.addEventListener('click', function(){

        // Ré-afficher le bouton de création de produit
        createBtn.classList.remove('hidden');

        // Masquer le formulaire
        formContainer.classList.add('hidden');

    })
}

function listenCreateButton(){

    if(createBtn){
        createBtn.addEventListener('click', onClickCreateBtn);
    }

    // Appel ajax en cas de création de produit
    const targetSaveBtn = document.querySelector('.Card-create-form .Card-save');

    targetSaveBtn.addEventListener('click',callCreatePartenaireAjax);

}

function callCreatePartenaireAjax()
{

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('#admin_partenaires .Card-create-form .ModifyForm'));
    formData.append('context', 'admin_update_partenaires');

    // Envoi de la requête pour créer le partenaire
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log('data = ' + data);

            // MAJ listing partenaires
            callDisplayPartenaireAjax();

            // Suppression du formulaire de création de produit
            this.parentNode.reset();

            // Ré-afficher le bouton de création de produit
            createBtn.classList.remove('hidden');

            // Masquer le formulaire
            formContainer.classList.add('hidden');

            listenCreateButton();
        });
}


function callModifyPartenaireAjax(card){

    // Création d'un nouvel objet FormData
    const formData = new FormData();
    formData.append('context', 'admin_modify_partenaires');
    formData.append('id',card.getAttribute('data-id'));

    // envoi requête pour maj card
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            card.innerHTML = data;
            listenCancelSaveBtns()
        })
}


function listenModifyDeleteBtns() {

    const modifyBtn = document.querySelectorAll('.Card-modify');
    const deleteBtn = document.querySelectorAll('.Card-delete');

    // MODIFIER LES INFOS DU PARTENAIRE
    modifyBtn.forEach(elt=> {
        elt.addEventListener('click', function (){

            let targetCard = this.parentNode;
            targetCard.setAttribute('data-form','modifying');
            console.log(targetCard);

            // Ne permettre qu'une modification de card à la fois
            let modifyCard = document.querySelector('.modify');
            if(!modifyCard){
                toggleClass(targetCard,'modify','unmodified');
                callModifyPartenaireAjax(targetCard);
                listenCancelSaveBtns();
                // picturePreview();
            }

        })
    })


    // SUPPRIMER UN PARTENAIRE
    deleteBtn.forEach(elt=> {
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            console.log(targetCard);

            let isToDelete = confirm('Souhaitez-vous supprimer ce partenaire ?');
            if(isToDelete === true) {

                // Création d'un nouvel objet FormData
                const formData = new FormData();
                formData.append('isToDelete','yes');
                formData.append('context', 'admin_delete_partenaire');
                formData.append('id',targetCard.getAttribute('data-id'));

                // envoi requête pour maj card
                fetch('ajax.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        targetCard.remove();
                    })
            }
        })
    })



}



function listenCancelSaveBtns(){
    const cancelBtn = document.querySelector('.Card.modify .Card-cancel');
    const saveBtn = document.querySelector('.Cards .Card-save');

    console.log('cancel = ' + cancelBtn);

    // ANNULER LES MODIFICATIONS
    cancelBtn.addEventListener('click', function (){
        //
        // e.preventDefault();
        console.log("Cancel button clicked");

        // Récupération de l'élément qui contiendra les cartes à mettre à jour
        let targetCard = document.querySelector('.Card.modify');
        console.log(targetCard);

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.ModifyForm'));
        formData.append('context', 'admin_cancel_modification_partenaire');
        formData.append('id',targetCard.getAttribute('data-id'));

        console.log('formData = ' + formData);

        // Envoi de la requête pour mettre à jour les cartes
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log('data = ' + data);

                // Mise à jour des cartes avec les données reçues
                targetCard.innerHTML = data;
                toggleClass(targetCard,'modify','unmodified');

                // Remettre en place les écouteurs sur modify et delete buttons
                listenModifyDeleteBtns();
            })
    })

    // SAUVEGARDER LES MODIFICATIONS
    saveBtn.addEventListener('click',function (event){
        let targetCard = document.querySelector('.Card.modify');
        toggleClass(targetCard,'save','unmodified');

        event.preventDefault();

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.Card.modify .ModifyForm'));
        formData.append('context','admin_update_partenaires');
        formData.append('id',targetCard.getAttribute('data-id'));

        console.log('formData = ' + formData);

        // Envoi de la requête pour mettre à jour les cartes
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log('data = ' + data);

                // Mise à jour des cartes avec les données reçues
                targetCard.innerHTML = data;
                toggleClass(targetCard,'modify','unmodified');

                // Remettre en place les écouteurs sur modify et delete buttons
                listenModifyDeleteBtns();
            })
    })
}

/**
 * Refresh la liste des partenaires
 */
function callDisplayPartenaireAjax(){
    // Récupération de l'élément qui contiendra les cartes à mettre à jour
    const cards = document.querySelector('#admin_partenaires #Cards');
    console.log('cards = ' + cards);

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('.creating form'));
    formData.append('context', cards.getAttribute('data-context'));

    console.log('formData = ' + formData);

    // Envoi de la requête pour mettre à jour les cartes
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log('data = ' + data);

            // Mise à jour des cartes avec les données reçues
            cards.innerHTML = data;
            listenModifyDeleteBtns();
        })

}


// function picturePreview(){
//     const fileInput = document.querySelector('.ModifyForm[data-form="modifying"] #picture');
//     const image = document.querySelector('.Card.modify[data-form="modifying"] .Card-imgBox-img');
//
//     console.log('picture here');
//
//     fileInput.addEventListener('change', (event) => {
//         const file = event.target.files[0];
//         const url = URL.createObjectURL(file);
//         image.src = url;
//     });
// }


listenModifyDeleteBtns();

if(createBtn){
    listenCreateButton();
}