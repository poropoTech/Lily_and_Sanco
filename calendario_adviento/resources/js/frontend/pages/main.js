$(function () {
    $('.carousel').each(function(){
        $(this).on('slide.bs.carousel', function () {
            $(this).find('.carousel-inner').addClass('carousel-inner-overflow');
        }).on('slid.bs.carousel', function () {
            $(this).find('.carousel-inner').removeClass('carousel-inner-overflow');
        });
    });


});
