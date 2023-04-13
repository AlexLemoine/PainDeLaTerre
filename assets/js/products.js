function toggleClassSelected(element){
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

function toggleClassFiltered(element){
    element.classList.toggle('filtered');
}

window.listenCards = function listenCards(){
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

listenCards();


let filters = document.querySelectorAll('.Products-filter-link');

filters.forEach(elt=>{
    elt.addEventListener('click', function (){
        let currentFilter = document.querySelector('.Products-filter-link.filtered');
        if(currentFilter){
            toggleClassFiltered(currentFilter);
        }
        toggleClassFiltered(elt);
    });
});
