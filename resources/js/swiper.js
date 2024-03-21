const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',

    loop: true,
    spaceBetween: 200,
    watchSlidesVisibility: true,
    centeredSlides: true,


    effect: 'coverflow',
    coverflowEffect: {
        rotate: 30,
        slideShadows: false,
    },

    grabCursor: true,


    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    breakpoints: {
        // when window width is <= 768px
        768: {
            slidesPerView: 1,
            spaceBetween: 50,
        },

        1024: {
            slidesPerView: 2.5,
            spaceBetween: 200,
        }
    }
});

const swiper2 = new Swiper('.swiper-2', {

    direction: 'horizontal',

    freeMode: true,
    loop: true,

    speed: 15000,


    // // Optional parameters
    // direction: 'horizontal',

    // loop: true,

    // slidesPerView: 3,
    // freeMode: true,
    // spaceBetween: 30,

    autoplay: {
        delay: 0,
    },

    // grabCursor: true,


    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next-2',
        prevEl: '.swiper-button-prev-2',
    },

    breakpoints: {
        // when window width is <= 768px
        768: {
            slidesPerView: 1,
            spaceBetween: 100,
        },

        1024: {
            slidesPerView: 2.5,
            spaceBetween: 100,
        }
    }

});