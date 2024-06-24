jQuery(document).ready(function ($) {

    const blogSwiper = new Swiper('#blog-block .swiper', {
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            375:{
                slidesPerView: 2,
                spaceBetween: 15,
            },
            769:{
                slidesPerView: 3,
                spaceBetween: 30,
            },
            992:{
                slidesPerView: 4,
                spaceBetween: 30,
            }
        },
        navigation: {
            prevEl: '#blog-block .swiper-btn-prev',
            nextEl: '#blog-block .swiper-btn-next',
        },
        pagination: {
            el: '#blog-block .swiper-pagination',
            clickable: true,
        }
    })

});