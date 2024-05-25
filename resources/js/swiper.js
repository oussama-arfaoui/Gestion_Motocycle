const default_swiper_styles = ["hero_slider_style1-swiper", "hero_slider_style2-swiper", "hero_slider_style3-swiper", "hero_slider_style4-swiper"]
const items_swiper_styles = ["gallery_overview_style5-swiper"];

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



for (let element of items_swiper_styles){
    const item_swiper = new Swiper(`.${element}`, {
        // Optional parameters
        direction: 'horizontal',
        slidesPerView: '2.5', 
        spaceBetween: 100,
        centeredSlides: true,

        loop: true,

        autoplay: {
            delay: 3000,
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
    
        breakpoints: {
            // when window width is >= 320px
            100: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: '2.5', 
                spaceBetween: 100,
            }
        }
    });
}