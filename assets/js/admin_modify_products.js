import {toggleClass} from "./functions.js";

// Récupération de la vue
const main = document.querySelector('main');
const view = main.getAttribute('id');

// Récupération du bouton de création
const createBtn = document.querySelector('.Card-create');

// Récupération de l'élément qui contient le form de création
let formContainer = document.querySelector('.Card-create-form');


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

    targetSaveBtn.addEventListener('click',callCreateProductAjax);

}

/**
 * Créer un produit en Ajax
 */
function callCreateProductAjax(){

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('#admin_products .Card-create-form .ModifyForm'));
    formData.append('context', 'admin_update_product');
    console.log('coucou');

    // Envoi de la requête pour créer le produit
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            console.log('ici');

            // Mise à jour du listing de produits
            callDisplayProductAjax();

            // Suppression du formulaire de création de produit
            this.parentNode.reset();

            // Ré-afficher le bouton de création de produit
            createBtn.classList.remove('hidden');

            // Masquer le formulaire
            formContainer.classList.add('hidden');

            listenCreateButton();
        });

}

function listenCancelSaveBtns(){
    const cancelBtn = document.querySelector('.modify .Card-cancel');
    const saveBtn = document.querySelector('.modify .Card-save');

    cancelBtn.addEventListener('click', function (){
        // Récupération de l'élément qui contiendra les cartes à mettre à jour
        let targetCard = document.querySelector('.Card.modify');

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.ModifyForm'));
        formData.append('context', 'admin_cancel_modification');
        formData.append('id',targetCard.getAttribute('data-id'));

        // Envoi de la requête pour mettre à jour les cartes
        fetch('ajax.php', {
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
    })

    saveBtn.addEventListener('click', function (event){
        event.preventDefault();

        let targetCard = document.querySelector('.modify');
        toggleClass(targetCard,'save','unmodified');

        console.log(targetCard);

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.modify .ModifyForm'));
        formData.append('context', 'admin_update_product');
        formData.append('id',targetCard.getAttribute('data-id'));

        // Envoi de la requête pour mettre à jour les cartes
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {

                console.log(data);
                // Mise à jour des cartes avec les données reçues
                targetCard.innerHTML = data;
                toggleClass(targetCard,'modify','unmodified');

                // Remettre en place les écouteurs sur modify et delete buttons
                listenModifyDeleteBtns();
            })
    });
}


/**
 * Appel Ajax pour mettre à jour la card sélectionnée à modifier
 * @param card
 */
function callModifyProductAjax(card){

    // Création d'un nouvel objet FormData
    const formData = new FormData();
    formData.append('context', 'admin_modify_products');
    formData.append('id',card.getAttribute('data-id'));

    // envoi requête pour maj card
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            card.innerHTML = data;
        })
        .then(() => listenCancelSaveBtns())
}


/**
 * Ecouteur sur bouton modify ou delete
 * Ajout classe modify ou delete sur la Card cliquée
 * Appel Ajax pour modification du produit
 */
function listenModifyDeleteBtns(){
    const modifyBtn = document.querySelectorAll('.Card-modify');
    const deleteBtn = document.querySelectorAll('.Card-delete');

    modifyBtn.forEach(elt=> {
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;

            // Ne permettre qu'une modification de card à la fois
            let modifyCard = document.querySelector('.modify');
            if(!modifyCard){
                toggleClass(targetCard,'modify','unmodified');
                callModifyProductAjax(targetCard);
                // listenCancelSaveBtns();
            }

        })
    })

    deleteBtn.forEach(elt=> {
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;

            let isToDelete = confirm('Souhaitez-vous supprimer ce produit ?');
            if(isToDelete === true) {

                // Création d'un nouvel objet FormData
                const formData = new FormData();
                formData.append('isToDelete','yes');
                formData.append('context', 'admin_delete_product');
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


function callDisplayProductAjax(){
    // Récupération de l'élément qui contiendra les cartes à mettre à jour
    const cards = document.querySelector('#Cards');

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('#form'));
    formData.append('context', cards.getAttribute('data-context'));

    // Envoi de la requête pour mettre à jour les cartes
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            // Mise à jour des cartes avec les données reçues
            cards.innerHTML = data;
            listenModifyDeleteBtns();
        })
}

// Récupération des éléments du formulaire
const form = document.querySelector('.layout-back .Search .Search-form');

if(form){

    // Ajout d'un écouteur d'événements pour détecter les changements dans le formulaire
    form.addEventListener('change', (e) => {

        // Empêcher le comportement par défaut du formulaire
        e.preventDefault();

        callDisplayProductAjax();
    });
}


listenModifyDeleteBtns();
if(createBtn){
    listenCreateButton();
}
