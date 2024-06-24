jQuery(document).ready(function($){

    const questions = $('#faq-block .qa');
    questions.each(function () {
        $(this).click(function (){
            let parent = $(this);
            let question = $(this).find('.question');
            let answer = $(this).find('.answer');
            $(this).toggleClass('opened').siblings().removeClass('opened');

            questions.each(function () {
                if($(this).hasClass('opened')){
                    $(this).find('.answer').slideDown();
                }else{
                    $(this).find('.answer').slideUp();
                }
            })
        })
    })

});