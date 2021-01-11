(function ($) {
    let app = {};
    app.header = function () {
        let $header = $('.header-main');
        if ($(window).scrollTop() === 0 && $(window).width() >= 975) {
            $header.addClass("navbar-dark");
            $header.removeClass("navbar-light");
        } else {
            $header.addClass("navbar-light");
            $header.removeClass("navbar-dark");
        }
    };
    app.parallax = function () {
        $('.jarallax').jarallax({
            speed: 0.2
        });
    };
    $(document).ready(function () {
        app.header();
        app.parallax();
    });
    $(window).scroll(function () {
        app.header();
    });
    $(window).resize(function () {
        app.header();
    });
})(jQuery);
