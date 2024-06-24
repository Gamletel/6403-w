jQuery(document).ready(function($){

    const productsSwiper = new Swiper('#products-block .swiper',{
        breakpoints:{
            320:{
                slidesPerView: 1,
                spaceBetween: 15,
            },
            498:{
                slidesPerView: 2,
                spaceBetween: 15,
            },
            769:{
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1221:{
                spaceBetween: 30,
                slidesPerView: 4,
            }
        },
        navigation:{
            prevEl:'#products-block .swiper-btn-prev',
            nextEl:'#products-block .swiper-btn-next',
        },
        pagination:{
            el: '#products-block .swiper-pagination',
            clickable: true,
        }
    })

});