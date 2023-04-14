/**
 * Ajouter la classe "selected" ou "unselected" à un élément sélectionné
 * @param element
 */
export function toggleClassSelected(element){
    if(!element.classList.contains('selected') && !element.classList.contains('unselected'))
    {
        element.classList.add('selected')
    }
    else if(element.classList.contains('selected'))
    {
        element.classList.remove('selected');
        element.classList.add('unselected');
    }
    else
    {
        element.classList.remove('unselected');
        element.classList.add('selected');
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
 * Placer des écouteurs d'évènements sur les Cards sélectionnées
 * Utiliser l'ajout ou la suppression de la classe "selected"
 * pour faire apparaître la zone description à la place de la zone ingrédients
 * ou inversement
 */
export function listenCards(){
    let cardButtonDesc = document.querySelectorAll('.layout-front .Card-desc');
    let cardButtonRecipe = document.querySelectorAll('.layout-front .Card-recipe');

    cardButtonDesc.forEach(elt=>{
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            toggleClassSelected(targetCard);
        });
    });

    cardButtonRecipe.forEach(elt=>{
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            toggleClassSelected(targetCard);
        });
    });
}
