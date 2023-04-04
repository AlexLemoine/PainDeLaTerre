// Récupération de l'élément select
const categoryLinks = document.querySelectorAll('#category a');

for (const link of categoryLinks)
{
    // Ajout d'un écouteur d'événements pour détecter les changements dans l'élément select
    link.addEventListener("click", (e) => {

        const containerAjax = document.getElementById('container-ajax');
        containerAjax.innerHTML =
            `<div style="text-center; margin-top: 15px;"><img alt="" src="img/spinner.svg"></div>`;

        e.preventDefault();

        fetch(link.href)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                containerAjax.innerHTML=data;
            });

    });

}

