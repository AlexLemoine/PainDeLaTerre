<p class="layout MainContent-topBack">Haut de page<img src="assets/img/FlecheHautDePage.png"></p>

<footer class="Footer">
    <div class="layout">

        <div class="Footer-SiteMap SiteMap">
            <h3 class="SiteMap-title">Plan du site</h3>
            <div class="SiteMap-list">
                <a href="#" class="SiteMap-list_title">Qui sommes-nous ?</a>
                <a href="#" class="SiteMap-list_title">Nos produits</a>
                <a href="#" class="SiteMap-list_title">Les actualités</a>
                <a href="#" class="SiteMap-list_title">Où nous trouver ?</a>
            </div>
        </div>

        <div class="Footer-Services Services">
            <h3 class="Services-title">Services</h3>
            <div class="Services-list">

                <a href="#" class="Services-list_title">Nous contacter</a>
                <a href="#" class="Services-list_title">Nous suivre</a>

                <a href="#" class="Services-list_socialNetwork">
                    <img src="assets/img/icon_Facebook.png">
                </a>
                <a href="#" class="Services-list_socialNetwork">
                    <img src="assets/img/icon_Instagram.png">
                </a>

            </div>
        </div>

        <div class="Footer-localisation Localisation">
            <h3 class="Localisation-title">Localisation</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2887.079292107864!2d5.582725030046796!3d43.64651860983737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9879e796d4d61%3A0xd4cfda91585ac695!2sLe%20Pain%20de%20la%20Terre!5e0!3m2!1sfr!2sfr!4v1681205429322!5m2!1sfr!2sfr"
                    width="300"
                    height="300"
                    style="border:0;"
                    allow="fullscreen"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <div class="Footer-mentions">
        <p>Copyright - Le Pain de la Terre 2023</p>
        <nav>
            <a href="#">Politique de confidentialité</a>
            <a href="#">Mentions légales</a>
        </nav>
    </div>

</footer>

<script>

    function addClassOpened(element){
        element.classList.toggle('opened');
    }

    function addClassSelected(element){
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

    function addClassFiltered(element){
        element.classList.toggle('filtered');
    }


    let burgerMenu = document.querySelector('div.Header-menu-burger');
    let burgerMenuLinks = document.querySelector('nav.Header-menu-links');
    let cardButtonDesc = document.querySelectorAll('.Card-desc');
    let cardButtonRecipe = document.querySelectorAll('.Card-recipe');
    let filters = document.querySelectorAll('.Products-filter-link');

    console.log(burgerMenu);
    console.log(burgerMenuLinks);
    console.log(cardButtonDesc);
    console.log(cardButtonRecipe);

    burgerMenu.addEventListener('click', function() {
        addClassOpened(burgerMenu);
        addClassOpened(burgerMenuLinks);
    });

    cardButtonDesc.forEach(elt=>{
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            addClassSelected(targetCard);
        });
    });

    cardButtonRecipe.forEach(elt=>{
        elt.addEventListener('click', function (){
            let targetCard = this.parentNode;
            addClassSelected(targetCard);
        });
    });

    filters.forEach(elt=>{
        elt.addEventListener('click', function (){
            let currentFilter = document.querySelector('.Products-filter-link.filtered');
            if(currentFilter){
                addClassFiltered(currentFilter);
            }
            addClassFiltered(elt);
        });
    });

</script>