(function ($) {
    let app = {};
    app.header = function () {
        let $header = $('.header-main', document);
        if ($(window).scrollTop() === 0 && $(window).width() >= 975) {
            $header.addClass("navbar-dark");
            $header.removeClass("navbar-light");
        } else {
            $header.addClass("navbar-light");
            $header.removeClass("navbar-dark");
        }
        document.querySelectorAll(".nav-link").forEach(link => {
            let section = document.querySelector(link.hash);
            if (
                section.offsetTop <= window.scrollY &&
                section.offsetTop + section.offsetHeight > window.scrollY
            ) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    };
    app.parallax = function () {
        $('.jarallax').jarallax({
            speed: 0.2
        });
    };
    $(document).ready(function () {
        app.header();
        app.parallax();
        $("a").on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                let hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 600, function(){
                    window.location.hash = hash;
                });
            }
        });
        $('#loading').fadeOut();
    });
    $(window).scroll(function () {
        app.header();
    });
    $(window).resize(function () {
        app.header();
    });

})(jQuery);
