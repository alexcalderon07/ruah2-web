(function ($) {

    function languageSlide() {
        var iL = $('.current-language').width();
        var lW = $('.languages').width();
        var lC = $('.languages a').length;
        $('.languages').css({"width": iL * lC, "left": -iL * lC});
        $('.languages a').css({width: iL});
        $('.languagewrapper').mouseover(function () {
            $('.languages').css({"left": iL});
        });
        $('.languagewrapper').mouseout(function () {
            $('.languages').css({"left": -iL * lC});
        });
    };

    function contentHeight() {
        var cH = $('.content-area').height();
        var sH = $('.sidebar').height();

        if (sH > cH) {
            $('.content-area').css({"min-height": sH});
        }
    };

    // gleiche Höhe für Elemente
    function equalHeights() {
        $('.row').each(function () {
            var highestBox = 0;
            $('.equal-height', this).each(function () {
                if ($(this).outerHeight() > highestBox) {
                    highestBox = $(this).outerHeight();
                }
            });
            $('.equal-height', this).outerHeight(highestBox);
        });
    };

    $(window).on('load', function () {

    });


    $(document).ready(function () {

        languageSlide();
        equalHeights();
        contentHeight();

    });


})(jQuery);
//
// $(function(){
//     function rescaleCaptcha(){
//         var width = $('.g-recaptcha').parent().width();
//         var scale;
//         if (width < 202) {
//             scale = width / 202;
//         } else{
//             scale = 1.0;
//         }
//
//         $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
//         $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
//         $('.g-recaptcha').css('transform-origin', '0 0');
//         $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
//     }
//
//     rescaleCaptcha();
//     $( window ).resize(function() { rescaleCaptcha(); });
//
// });
