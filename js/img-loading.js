function load(img) {
    const url = img.getAttribute('data-src');
    img.setAttribute('src', url)
    img.setAttribute('data-status', 1)
    img.removeAttribute('data-src')
        // img.classList.add('img-effect');
}

function readyLazy() {
    if ('IntersectionObserver' in window) {
        var lazyImgs = document.querySelectorAll('[data-src]')

        // let options = {
        //     root: null,
        //     rootMargin: '0px',
        //     threshold: 0.25
        // };

        let observer = new IntersectionObserver((entries) => {
            entries.forEach(entries => {
                if (entries.isIntersecting && entries.target.getAttribute('data-status') == 0) {
                    load(entries.target)
                }
            })
        });

        lazyImgs.forEach(img => {
            observer.observe(img)
        })
    }
}
document.addEventListener('DOMContentLoaded', readyLazy);