/**
 * Ajouter la classe "classed" ou "unclassed" à un élément sélectionné
 * "classed" et "unclassed" sont à définir en paramètres
 * @param element
 * @param classed
 * @param unclassed
 */
export function toggleClass(element,classed,unclassed){
    if(!element.classList.contains(classed) && !element.classList.contains(unclassed))
    {
        element.classList.add(classed)
    }
    else if(element.classList.contains(classed))
    {
        element.classList.remove(classed);
        element.classList.add(unclassed);
    }
    else
    {
        element.classList.remove(unclassed);
        element.classList.add(classed);
    }
}


/**
 * Ajouter la classe "filtered" à un élément sélectionné s'il n'a pas déjà cette classe
 * S'il l'a déjà, enlever cette classe
 * @param element
 */
export function toggleClassFiltered(element){
    element.classList.toggle('filtered');
}


/**
 * Au survol de la card, afficher l'image secondaire à la place de l'image principale
 */
export function switchMainSecondaryPicture(){
    const cards = document.querySelectorAll('.Products .Card');

    cards.forEach(function(card) {
        const img1 = card.querySelector('#img1');
        const img2 = card.querySelector('#img2');

        card.addEventListener('mouseover', function() {
            img1.classList.add('hidden');
            img2.classList.remove('hidden');
        });
        card.addEventListener('mouseout', function() {
            img1.classList.remove('hidden');
            img2.classList.add('hidden');
        });
    });
}

