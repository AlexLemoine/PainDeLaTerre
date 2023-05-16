function startSlider() {
    const slider = document.querySelector('.CompanySlider');
    const slideContainer = slider.querySelector('.slide-container');
    const slides = slideContainer.querySelectorAll('.CompanySlider-imgBox');
    const slideCount = slides.length;
    const slideWidth = slides[0].offsetWidth;

    let counter1 = 0;
    let counter2 = 1;
    let counter3 = 2;

    function updateSlide() {
        slideContainer.style.transition = 'transform 0.4s ease-in-out';
        slideContainer.style.transform = `translateX(-${slideWidth * counter1}px)`;
    }

    setInterval(() => {
        counter1++;
        counter2++;
        counter3++;

        if (counter1 >= slideCount) {
            counter1 = 0;
        }
        if (counter2 >= slideCount) {
            counter2 = 0;
        }
        if (counter3 >= slideCount) {
            counter3 = 0;
        }

        updateSlide();
    }, 2000);
}

startSlider();

// TODO Prévoir le fait de boucler à l'infini
//  au lieu de revenir au début du slider tout à gauche