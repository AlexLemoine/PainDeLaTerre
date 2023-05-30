import {toggleClass} from "./functions.js";

const modifyBtn = document.querySelectorAll('#gamme .Card-modify, #produits .Card-modify, #partenaires .Card-modify');

function listenCancelSaveBtns() {

    const cancelBtn = document.querySelector('.modify .ModifyForm .Card-cancel');
    const saveBtn = document.querySelector('.modify .ModifyForm .Card-save');

    console.log('cancelBtn de fonction listenCancel =' + cancelBtn);
    console.log('saveBtn de fonction listenCancel =' + saveBtn);

    // ANNULER LES MODIFICATIONS
    cancelBtn.addEventListener('click', function (){

        let targetSection = document.querySelector('.modify');
        console.log('section entière =' + targetSection);

        // Lieu où se trouvera la vue partielle
        let container = document.querySelector('.modify .container-text');
        console.log('container = ' + container);

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.ModifyForm'));
        formData.append('context', 'admin_cancel_modification_presentation');
        formData.append('id',targetSection.getAttribute('data-id'));

        console.log('formDataValues = ' + formData.values());

        // Envoi de la requête pour mettre à jour les cartes
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {

                console.log('data cancel =' + data);
                // Mise à jour des cartes avec les données reçues
                container.innerHTML = data;

                const modifyBtn = document.querySelector('.modify .Card-modify');
                console.log(modifyBtn);
                toggleClass(targetSection,'modify','unmodified');

                // Remettre en place le modifyBtn et son écouteur
                console.log('modifyBtn' + modifyBtn);
                toggleClass(modifyBtn,'hidden','visible');
                listenModifyBtn();
            })
    })


    // SAUVEGARDER LES MODIFICATIONS
    saveBtn.addEventListener('click',function (event){

        let targetSection = document.querySelector('.Presentation .modify')

        // Lieu où se trouvera la vue partielle
        let container = document.querySelector('.modify .container-text');
        console.log('container = ' + container);
        toggleClass(container,'save','unmodified');

        // Création d'un nouvel objet FormData
        const formData = new FormData(document.querySelector('.modify .ModifyForm'));
        formData.append('context','admin_update_presentation');
        formData.append('id',targetSection.getAttribute('data-id'));
        console.log(formData.values());

        // Envoi de la requête pour mettre à jour la présentation
        fetch('ajax.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {

                // Mise à jour du partenaire avec les données reçues
                container.innerHTML = data;
                toggleClass(targetSection,'modify','unmodified');

                // Remettre en place le bouton modify et son écouteur
                const modifyBtn = document.querySelector('.Card-modify.hidden')
                toggleClass(modifyBtn,'hidden','visible');
                listenModifyBtn();

            })
    })
}


function callModifyPresentationAjax(targetSection) {

    // Lieu où se trouvera la vue partielle
    let container = document.querySelector('.modify .container-text');

    // Création d'un nouvel objet FormData
    const formData = new FormData();
    formData.append('context', 'admin_modify_presentation');
    formData.append('id',targetSection.getAttribute('data-id'));
    console.log(formData);

    // envoi requête pour maj présentation
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            container.innerHTML = data;
            listenCancelSaveBtns();
        })

}


function listenModifyBtn() {

    // MODIFIER LES INFOS DU PARTENAIRE
    modifyBtn.forEach(elt=> {
        elt.addEventListener('click', function () {

            let targetSection = this.parentNode;
            console.log(targetSection);
            targetSection.setAttribute('data-form', 'modifying');

            // Ne permettre qu'une modification de presentation à la fois
            let modifySection = document.querySelector('.modify')
            if (!modifySection) {

                toggleClass(targetSection, 'modify', 'unmodified');

                const targetModifyBtn = document.querySelector('.modify .Card-modify');
                console.log(targetModifyBtn);
                toggleClass(targetModifyBtn,'hidden','visible');

                callModifyPresentationAjax(targetSection);
            }

        })
    })
}

listenModifyBtn();