import {toggleClass} from "./functions.js";


function onCLickCreateBtn() {

    const container = document.querySelector('.Presentation-sliderCompany-container');
    const creationSection = document.querySelector('.Presentation-sliderCompany-creation');
    const cancelBtn = document.querySelector('#sliderCompany .Presentation-sliderCompany-creation .ModifyForm .Card-cancel');

    console.log('click cancelBtn');

    toggleClass(creationSection,'hidden','visible');
    toggleClass(createBtn,'hidden','visible');
    toggleClass(modifySliderBtn,'hidden','visible');
    toggleClass(container,'hidden','visible');

    cancelBtn.removeEventListener('click', onCLickCreateBtn);
}


function onClickSaveBtn() {

    // Lieu où on chargera la vue partielle
    const container = document.querySelector('.Presentation-sliderCompany-container');

    const creationSection = document.querySelector('.Presentation-sliderCompany-creation');
    const creationForm = document.querySelector('.Presentation-sliderCompany-creation .ModifyForm');

    // Création d'un nouvel objet FormData
    const formData = new FormData(creationForm);
    formData.append('context', 'admin_create_slide_company');

    // Envoi de la requête pour créer le produit
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            // Mise à jour du listing des sliders
            container.innerHTML = data;

            // Remise à zéro du formulaire de création de produit
            this.parentNode.reset();

            // On cache le formulaire de création
            toggleClass(creationSection,'hidden','visible');

            // On réaffiche le container avec le listing des slides
            toggleClass(container,'hidden','visible');

            // On fait réapparaître les boutons ou on les recache en fonction de leur état
            toggleClass(createBtn,'hidden','visible');
            toggleClass(modifySliderBtn,'hidden','visible');

            const saveBtn = document.querySelector('#sliderCompany .Presentation-sliderCompany-creation .ModifyForm .Card-save');
            saveBtn.removeEventListener('click',onClickSaveBtn);

        })

}

function listenCreateSliderBtn() {

    const container = document.querySelector('.Presentation-sliderCompany-container');

    // Ecouteur sur le bouton create
    // Au click, faire apparaître le formulaire de création de slide
    createBtn.addEventListener('click', function (){

        console.log('click createBtn');

        const creationForm = document.querySelector('.Presentation-sliderCompany-creation');
        toggleClass(creationForm,'hidden','visible');
        toggleClass(createBtn,'hidden','visible');
        toggleClass(modifySliderBtn,'hidden','visible');
        toggleClass(container,'hidden','visible');

        // Au clic sur annuler, on recache le formulaire de création
        // On fait réapparaître les boutons ou on les recache en fonction de leur état
        const cancelBtn = document.querySelector('#sliderCompany .Presentation-sliderCompany-creation .ModifyForm .Card-cancel');
        cancelBtn.addEventListener('click', onCLickCreateBtn);

        // TODO ecouter saveBtn
        // TODO create en BDD en AJAX

        // Au clic sur Enregistrer, on ajoute la slide en BDD
        // On renvoie la vue partielle au container en Ajax
        // On cache le formulaire de création
        // On fait réapparaître les boutons ou on les recache en fonction de leur état
        const saveBtn = document.querySelector('#sliderCompany .Presentation-sliderCompany-creation .ModifyForm .Card-save');
        saveBtn.addEventListener('click', onClickSaveBtn);


    })

}



function listenCancelBtn(container){
    // Ecouteur sur le bouton cancel
    // Au click, faire un refresh du CompanySlider entier
    const cancelBtn = document.querySelector('#sliderCompany .Presentation-sliderCompany-container .ModifyForm .Card-cancel');
    cancelBtn.addEventListener('click', function () {

        // Création d'un nouvel objet FormData
        const formData = new FormData();
        formData.append('context', 'admin_cancel_sliderCompany');

        // envoi requête pour refresh les images du slider savoir-faire
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {

                container.innerHTML = data;

                // Faire apparaître les boutons create et modify de nouveau
                toggleClass(createBtn,'hidden','visible');
                toggleClass(modifySliderBtn,'hidden','visible');
            })

    })
}


function listenSaveBtn(container) {
    const saveBtn = document.querySelector('#sliderCompany .ModifyForm .Card-save');

    // Création d'un nouvel objet FormData
    const formData = new FormData();
    formData.append('context', 'admin_update_sliderCompany');

    let inputUrl = document.querySelectorAll('input[type="file"]');

    inputUrl.forEach(input => {
        input.addEventListener('change', function (e){
            formData.append('id'+input.getAttribute('data-id'),input.getAttribute('data-id'));
            formData.append('url'+input.getAttribute('data-id'),e.target.files[0]['name']);
            console.log(e.target.files[0]['name']);
        })
    });

    // Ecouteur sur le bouton cancel
    // Au click, update en BDD de chaque élémént modifié,
    // Refresh du CompanySlider entier
    saveBtn.addEventListener('click', function (event) {

        event.preventDefault();

        // envoi requête pour refresh les images du slider savoir-faire
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {

                container.innerHTML = data;

                // Faire apparaître le bouton modify de nouveau
                toggleClass(modifySliderBtn,'hidden','visible');
            })

    })
}


function listenDeleteBtn() {
    const deleteBtn = document.querySelectorAll('.Presentation-sliderCompany-imgBox .Card-delete');
    deleteBtn.forEach(btn => {
        btn.addEventListener('click', function (event) {

            event.preventDefault();

            const targetSlide = this.parentNode;
            console.log(targetSlide);

            let isToDelete = confirm('Souhaitez-vous supprimer ce partenaire ?');
            if(isToDelete === true) {

                // Création d'un nouvel objet FormData
                const formData = new FormData();
                formData.append('isToDelete','yes');
                formData.append('context', 'admin_delete_slide_company');
                formData.append('id',targetSlide.getAttribute('data-id'));

                // envoi requête pour maj card
                fetch('ajax.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        targetSlide.remove();

                    })

            }

        })
    })

}


/**
 * Ecouter les boutons cancel, save et delete
 */
function listenCancelDeleteSaveBtn() {

    // Lieu où va se rafraîchir la vue partielle
    const container = document.querySelector('.Presentation-sliderCompany-container');

    listenCancelBtn(container);

    listenSaveBtn(container);

    listenDeleteBtn();

}


function callModifySliderCompanyAjax(container) {

    // Création d'un nouvel objet FormData
    const formData = new FormData();
    formData.append('context', 'admin_modify_sliderCompany');

    // envoi requête pour maj des images du slider savoir-faire
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {

            container.innerHTML = data;
            listenCancelDeleteSaveBtn();
        })
}

function listenModifySliderBtn(){
    modifySliderBtn.addEventListener('click', function () {

        toggleClass(createBtn,'hidden','visible');
        toggleClass(modifySliderBtn,'hidden','visible');

        let container = document.querySelector('.Presentation-sliderCompany-container');
        callModifySliderCompanyAjax(container);

    });
}

const createBtn =  document.querySelector('#sliderCompany .Card-create-button');
let addEventCreate = 0;

if(addEventCreate === 0){
    listenCreateSliderBtn();
    addEventCreate = 1;
}



const modifySliderBtn = document.querySelector('#sliderCompany .Card-modify');
listenModifySliderBtn();

