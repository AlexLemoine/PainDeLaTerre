// Récupération des éléments du formulaire
const form = document.querySelector('.layout-back .Search .Search-form');
console.log('form = ' + form);

// Ajout d'un écouteur d'événements pour détecter les changements dans le formulaire
form.addEventListener('change', (e) => {

    e.preventDefault();

    // Récupération de l'élément qui contiendra les cartes à mettre à jour
    const cards = document.querySelector('#Cards');
    console.log('cards = ' + cards);

    // Création d'un nouvel objet FormData
    const formData = new FormData(document.querySelector('#form'));
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

        })
})
