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

    app.form = function() {
        $("#contact-form", document).submit(function(e) {
            e.preventDefault();
            $('#contact-submit', document).text('Proszę czekać...').attr('disabled', 'disabled');
            $.ajax({
                method: "POST",
                url: "/contact",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]', document).attr('content')
                },
                data: {
                    name: $('#contact-name', document).val(),
                    email: $('#contact-email', document).val(),
                    content: $('#contact-message', document).val(),
                },
                dataType: 'json',
                success: function () {
                    $('#contact-submit', document).text('Wiadomość wysłana').removeClass('btn-primary').addClass('btn-success');
                },
                error: function () {
                    $('#contact-submit', document).text('Wystąpił błąd. Spróbuj ponownie później.').removeClass('btn-primary').addClass('btn-warning');
                }
            });

        });
    };

    $(document).ready(function () {
        app.header();
        app.parallax();
        app.form();
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
