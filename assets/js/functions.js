/**
 * Ajouter la classe "selected" ou "unselected" à un élément sélectionné
 * @param element
 * **/
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
 * Placer des écouteurs d'évènements sur les Desc ou Recipes des Cards sélectionnées
 * Utiliser l'ajout ou la suppression de la classe "selected"
 * pour faire apparaître la zone description à la place de la zone ingrédients
 * ou inversement
 */
export function switchDescRecipe(){
    let cardButtonDesc = document.querySelectorAll('.layout-front .Card-desc');
    let cardButtonRecipe = document.querySelectorAll('.layout-front .Card-recipe');

    cardButtonDesc.forEach(elt=>{
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            toggleClass(targetCard,'selected','unselected');

        });
    });

    cardButtonRecipe.forEach(elt=>{
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            toggleClass(targetCard,'selected','unselected');
        });
    });
}

/**
 * Au survol de la card, afficher l'image secondaire à la place de l'image principale
 */
export function switchMainSecondaryPicture(){
    const cards = document.querySelectorAll('.Products .Card, .SliderProduct .Card');

    cards.forEach(function(card) {
        const img1 = card.querySelector('#img1');
        const img2 = card.querySelector('#img2');

        card.addEventListener('mouseover', function() {

            console.log('card =' + card);
            console.log(img1);
            console.log(img2);

            img1.classList.add('hidden');
            img2.classList.remove('hidden');
        });
        card.addEventListener('mouseout', function() {
            img1.classList.remove('hidden');
            img2.classList.add('hidden');
        });
    });
}