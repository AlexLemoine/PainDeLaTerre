const slider = document.querySelector('.CompanySlider');
const slideContainer = slider.querySelector('.slide-container');
const slides = slideContainer.querySelectorAll('.CompanySlider-imgBox');
const slideCount = slides.length;
const slideWidth = slides[0].getBoundingClientRect().width;
let counter = 0;

function startSlider() {

    setInterval(() => {
        counter++;

        if (counter === slideCount - 2) {
            counter = 0;
        }

        updateSlide();
    }, 2500);
}

function updateSlide() {
    slideContainer.style.transition = 'transform 0.4s ease-in-out';
    slideContainer.style.transform = `translateX(-${slideWidth * counter}px)`;
}

startSlider();

