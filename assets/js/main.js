
function toggleClassOpened(element){
    element.classList.toggle('opened');
}


let burgerMenu = document.querySelector('div.Header-menu-burger');
let burgerMenuLinks = document.querySelector('nav.Header-menu-links');

console.log(burgerMenu);
console.log(burgerMenuLinks);

burgerMenu.addEventListener('click', function() {
    toggleClassOpened(burgerMenu);
    toggleClassOpened(burgerMenuLinks);
});