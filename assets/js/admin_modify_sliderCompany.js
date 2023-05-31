import {toggleClass} from "./functions.js";



function listenCancelSaveBtn() {

    // Ecouteur sur le bouton cancel
    // Au click, faire un refresh du CompanySlider entier
    const cancelBtn = document.querySelector('#sliderCompany .ModifyForm .Card-cancel');
    cancelBtn.addEventListener('click', function () {

        // Lieu où va se rafraîchir la vue partielle
        const container = document.querySelector('.Presentation-sliderCompany-container');

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

    // TODO - EN AJAX: UPDATE EN BDD
    const saveBtn = document.querySelector('#sliderCompany .ModifyForm .Card-save');
    saveBtn.addEventListener('click', function () {
        console.log(saveBtn);

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

