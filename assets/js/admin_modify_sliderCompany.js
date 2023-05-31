import {toggleClass} from "./functions.js";



function listenCancelSaveBtn() {
    // Lieu où va se rafraîchir la vue partielle
    const container = document.querySelector('.Presentation-sliderCompany-container');

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
            listenCancelSaveBtn();
        })
}

function listenModifySliderBtn(){
    modifySliderBtn.addEventListener('click', function () {

        toggleClass(modifySliderBtn,'hidden','visible');

        let container = document.querySelector('.Presentation-sliderCompany-container');
        callModifySliderCompanyAjax(container);

    });
}

const modifySliderBtn = document.querySelector('#sliderCompany .Card-modify');
listenModifySliderBtn();

