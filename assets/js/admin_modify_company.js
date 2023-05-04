// Récupération du bouton de création
const createBtn = document.querySelector('#admin_company .Card-create');
// Récupération de l'élément qui contient le form de création
let formContainer = document.querySelector('#admin_company .Card-create-form');


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
    // Récupération de l'élément qui contiendra les cartes à mettre à jour
    const table = document.querySelector('.Table');

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('#admin_company .Card-create-form .ModifyForm'));
    formData.append('context', 'admin_update_partenaires');

    // Envoi de la requête pour créer le partenaire
    fetch('ajax.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log('data = ' + data);

            table.innerHTML+= data;

            // Suppression du formulaire de création de produit
            this.parentNode.reset();

            // Ré-afficher le bouton de création de produit
            createBtn.classList.remove('hidden');

            // Masquer le formulaire
            formContainer.classList.add('hidden');

            listenCreateButton();

        });
}


// function callDisplayPartenaireAjax()
// {
//     // Récupération de l'élément qui contiendra les cartes à mettre à jour
//     const table = document.querySelector('.Table');
//
//     // Création d'un nouvel objet FormData
//     const formData = new FormData();
//     formData.append('context', table.getAttribute('data-context'));
//
//     // Envoi de la requête pour mettre à jour les cartes
//     fetch('ajax.php', {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => response.text())
//         .then(data => {
//             console.log('data = ' + data);
//
//             // Mise à jour des cartes avec les données reçues
//             table.innerHTML += data;
//             listenModifyDeleteBtns();
//         })
//
// }

if(createBtn){
    listenCreateButton();
}