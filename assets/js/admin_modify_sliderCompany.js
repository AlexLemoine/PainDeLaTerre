import {toggleClass} from "./functions.js";

const modifySliderBtn = document.querySelector('#sliderCompany .Card-modify');
console.log(modifySliderBtn);

// TODO
function listenCancelSaveBtns() {
    console.log('TODO function listenCancelSaveBtn')
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
            listenCancelSaveBtns();
        })
}

function listenModifySliderBtn(){
    modifySliderBtn.addEventListener('click', function () {

        toggleClass(modifySliderBtn,'hidden','visible');

        let container = document.querySelector('.Presentation-sliderCompany-container');
        callModifySliderCompanyAjax(container);

    });
}

listenModifySliderBtn();

