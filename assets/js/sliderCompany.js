const slider = document.querySelector('.CompanySlider');
const slideContainer = slider.querySelector('.slide-container');
const slides = slideContainer.querySelectorAll('.CompanySlider-imgBox');
const slideCount = slides.length;
const slideWidth = slides[0].getBoundingClientRect().width;
let counter1 = 0;

function startSlider() {

    setInterval(() => {
        counter1++;

        if (counter1 === slideCount - 2) {
            counter1 = 0;
        }

        updateSlide();
    }, 2500);
}

function updateSlide() {
    slideContainer.style.transition = 'transform 0.4s ease-in-out';
    slideContainer.style.transform = `translateX(-${slideWidth * counter1}px)`;
}

startSlider();
