const tags = document.querySelectorAll('.Boulangerie-encart-tag');

window.addEventListener('scroll', function() {
    const windowHeight = window.innerHeight;
    const scrollPosition = window.scrollY;

    for (let i = 0; i < tags.length; i++) {
        const tag = tags[i];
        const tagTop = tag.offsetTop;
        const tagHeight = tag.offsetHeight;

        const tagVisibleStart = tagTop + tagHeight * 0.4; // 40% de visibilité
        const tagVisibleEnd = tagTop + tagHeight - tagHeight * 0.4; // 40% de visibilité

        if (scrollPosition + windowHeight > tagVisibleStart && scrollPosition < tagVisibleEnd) {
            tag.classList.add('visible');
        } else {
            tag.classList.remove('visible');
        }
    }
});