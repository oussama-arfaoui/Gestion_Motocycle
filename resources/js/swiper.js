const default_swiper_styles = ["hero_slider_style1-swiper", "hero_slider_style2-swiper", "hero_slider_style3-swiper", "hero_slider_style4-swiper"]

for (let element of default_swiper_styles) {

    const default_swiper = new Swiper(`.${element}`, {
        // Optional parameters
        direction: 'horizontal',
        centeredSlides: true,
        slidesPerView: '1', // Allow each slide to take up the entire screen width

        loop: true,

        autoplay: {
            delay: 5000,
        },

        // If we need pagination
        pagination: {
            el: `.${element}-pagination`,
        },

        // Navigation arrows
        navigation: {
            nextEl: `.${element}-button-next`,
            prevEl: `.${element}-button-prev`,
        },
        // And if we need scrollbar
        scrollbar: {
            el: `.${element}-scrollbar`,
        },
    });
}









// const swiper = new Swiper('.swiper', {
//     // Optional parameters
//     direction: 'horizontal',

//     loop: true,
//     spaceBetween: 200,
//     watchSlidesVisibility: true,
//     centeredSlides: true,


//     effect: 'coverflow',
//     coverflowEffect: {
//         rotate: 30,
//         slideShadows: false,
//     },

//     grabCursor: true,


//     // Navigation arrows
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },

//     breakpoints: {
//         // when window width is <= 768px
//         768: {
//             slidesPerView: 1,
//             spaceBetween: 50,
//         },

//         1024: {
//             slidesPerView: 2.5,
//             spaceBetween: 200,
//         }
//     }
// });

// const swiper2 = new Swiper('.swiper-2', {

//     direction: 'horizontal',

//     freeMode: true,
//     loop: true,

//     speed: 15000,


//     // // Optional parameters
//     // direction: 'horizontal',

//     // loop: true,

//     // slidesPerView: 3,
//     // freeMode: true,
//     // spaceBetween: 30,

//     autoplay: {
//         delay: 0,
//     },

//     // grabCursor: true,


//     // Navigation arrows
//     navigation: {
//         nextEl: '.swiper-button-next-2',
//         prevEl: '.swiper-button-prev-2',
//     },

//     breakpoints: {
//         // when window width is <= 768px
//         768: {
//             slidesPerView: 1,
//             spaceBetween: 100,
//         },

//         1024: {
//             slidesPerView: 2.5,
//             spaceBetween: 100,
//         }
//     }

// });