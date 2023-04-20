import {toggleClass} from "./functions.js";
import {callDisplayProductAjax} from "./admin_ajax.js";

function listenCreateButton() {
    const createBtn = document.querySelector('.Card-create');

    createBtn.addEventListener('click', function () {
        createBtn.classList.add('hidden');

        // Récupération de l'élément qui contiendra le form de création
        let containerAjax = document.querySelector('.Card-create-form');
        toggleClass(containerAjax,'creating','uncreated');
        containerAjax.innerHTML = `<p class="Card-create-title">Création du produit</p>`

        // Création d'un nouvel objet FormData
        const formData = new FormData();
        formData.append('context', 'admin_modify_products');

        // Envoi de la requête pour mettre à jour les cartes
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                console.log('data = ' + data);

                // Mise à jour des cartes avec les données reçues
                containerAjax.innerHTML += data;

                const targetCancelBtn = document.querySelector('.Card-create-form .Card-cancel');
                targetCancelBtn.addEventListener('click', function(){
                   this.parentNode.remove();
                    createBtn.classList.remove('hidden');
                    toggleClass(containerAjax,'creating','uncreated');
                })

                const targetSaveBtn = document.querySelector('.Card-create-form .Card-save');
                targetSaveBtn.addEventListener('click',function(){

                    // Création d'un nouvel objet FormData
                    const formData = new FormData(document.querySelector('.ModifyForm'));
                    formData.append('context', 'admin_update_product');

                    // Envoi de la requête pour créer le produit
                    fetch('ajax.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {
                            console.log('data = ' + data);

                            // Mise à jour du listing de produits
                            callDisplayProductAjax();

                            // Suppression du formulaire de création de produit
                            this.parentNode.remove();
                        });

                })
            })
    })
}


function listenCancelSaveBtns(){
    const cancelBtn = document.querySelector('.Cards .Card-cancel');
    const saveBtn = document.querySelector('.Cards .Card-save');

    cancelBtn.addEventListener('click', function (){
        // Récupération de l'élément qui contiendra les cartes à mettre à jour
        let targetCard = document.querySelector('.Card.modify');

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.ModifyForm'));
        formData.append('context', 'admin_cancel_modification');
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

    saveBtn.addEventListener('click', function (){
        let targetCard = document.querySelector('.Card.modify');
        toggleClass(targetCard,'save','unmodified');

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.ModifyForm'));
        formData.append('context', 'admin_update_product');
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
            console.log(data);
            card.innerHTML = data;
            listenCancelSaveBtns();
        })
}

/**
 * Ecouteur sur bouton modify ou delete
 * Ajout classe modify ou delete sur la Card cliquée
 * Appel Ajax pour modification du produit
 */
export function listenModifyDeleteBtns(){
    const modifyBtn = document.querySelectorAll('.Card-modify');
    const deleteBtn = document.querySelectorAll('.Card-delete');

    modifyBtn.forEach(elt=> {
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            console.log(targetCard);

            // Ne permettre qu'une modification de card à la fois
            let modifyCard = document.querySelector('.modify');
            if(!modifyCard){
                toggleClass(targetCard,'modify','unmodified');
                callModifyProductAjax(targetCard);
                listenCancelSaveBtns();
            }

        })
    })

    deleteBtn.forEach(elt=> {
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            console.log(targetCard);
            toggleClass(targetCard,'delete','unmodified');

            let isToDelete = confirm('Souhaitez-vous supprimer ce produit ?');
            if(isToDelete === true) {

                // Création d'un nouvel objet FormData
                const formData = new FormData();
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

listenModifyDeleteBtns();
listenCreateButton();