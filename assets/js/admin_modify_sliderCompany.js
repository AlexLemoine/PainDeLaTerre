import {toggleClass} from "./functions.js";

function listenCreateSliderBtn() {

    const container = document.querySelector('.Presentation-sliderCompany-container');

    // Ecouteur sur le bouton create
    // Au click, faire apparaître le formulaire de création de slide
    createBtn.addEventListener('click', function (){

        const creationForm = document.querySelector('.Presentation-sliderCompany-creation');
        toggleClass(creationForm,'hidden','visible');
        toggleClass(createBtn,'hidden','visible');
        toggleClass(modifySliderBtn,'hidden','visible');
        toggleClass(container,'hidden','visible');

        // TODO

    })

}



function listenCancelBtn(container){
    // Ecouteur sur le bouton cancel
    // Au click, faire un refresh du CompanySlider entier
    const cancelBtn = document.querySelector('#sliderCompany .ModifyForm .Card-cancel');
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

                // Faire apparaître le bouton modify de nouveau
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

        toggleClass(modifySliderBtn,'hidden','visible');

        let container = document.querySelector('.Presentation-sliderCompany-container');
        callModifySliderCompanyAjax(container);

    });
}

const createBtn =  document.querySelector('#sliderCompany .Card-create-button');
listenCreateSliderBtn();

const modifySliderBtn = document.querySelector('#sliderCompany .Card-modify');
listenModifySliderBtn();

