window.addEventListener('scroll', function() {
    const tags = document.querySelectorAll('.Boulangerie-encart-tag');
    const windowHeight = window.innerHeight;

    for (let i = 0; i < tags.length; i++) {
        const tag = tags[i];
        const tagTop = tag.getBoundingClientRect().top;

        if (tagTop < windowHeight) {
            tag.classList.add('visible');
        }
    }
});