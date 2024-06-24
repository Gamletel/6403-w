jQuery(document).ready(function($){

    const stocksSwiper = new Swiper('#stocks-block .swiper',{
        spaceBetween: 30,
        breakpoints:{
            320:{
              slidesPerView: 1,
            },
            576:{
                slidesPerView: 2,
            }
        },
        navigation:{
            prevEl: '#stocks-block .swiper-btn-prev',
            nextEl: '#stocks-block .swiper-btn-next',
        },
        pagination:{
            el: '#stocks-block .swiper-pagination',
            clickable: true,
        }
    })

});