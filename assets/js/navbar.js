
// HEADER
$(function() {


    if ($('.header-home').length > 0) {
        $(window).scroll(function () {
            const distanceY = window.pageYOffset || document.documentElement.scrollTop,
                scroll = 200;
            if (distanceY > scroll) {
                $('header').addClass("changeColor").removeClass('logo-blanc');
            } else {
                $('header').removeClass("changeColor").addClass('logo-vert');
            }
        });
    }
});


