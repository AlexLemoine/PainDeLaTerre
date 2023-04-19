import * as i from './functions.js';

// Récupération de l'élément select
const categoryLinks = document.querySelectorAll('#category a');

for (const link of categoryLinks)
{
    // Ajout d'un écouteur d'événements pour détecter les changements dans l'élément select
    link.addEventListener("click", (e) => {

        const containerAjax = document.getElementById('container-ajax');

        e.preventDefault();

        fetch(link.href)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                containerAjax.innerHTML=data;
                i.switchDescRecipe();
            });

    });

}


