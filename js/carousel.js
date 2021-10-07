$(".carousel-product").owlCarousel({
    margin: 20,
    loop: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        700: {
            items: 3,
            nav: false
        },
        1000: {
            items: 4,
            nav: false
        }
    }
});

$(".carousel-promotion").owlCarousel({
    margin: 310,
    loop: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        700: {
            items: 3,
            nav: false
        },
        1000: {
            items: 4,
            nav: false
        }
    }
});