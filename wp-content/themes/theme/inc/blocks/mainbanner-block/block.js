jQuery(document).ready(function($){

    const mainbannerSwiper = new Swiper('#mainbanner-block .swiper',{
        slidesPerView: 1,
        parallax: true,
        autoHeight: true,
        speed: 1200,
        navigation:{
            prevEl: '#mainbanner-block .swiper-btn-prev',
            nextEl: '#mainbanner-block .swiper-btn-next',
        }
    })

});