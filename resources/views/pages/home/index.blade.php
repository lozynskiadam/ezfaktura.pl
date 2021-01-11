<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>{{ env('APP_NAME') }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
    <link rel="icon" href="assets/img/icon.png" type="image/png"/>
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Lato:300,400,700,900"]},
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['/assets/css/fonts.min.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/landing.css">
</head>
<body>
<header class="header-main fixed-top navbar-dark">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img class="logo-dark" src="assets/img/logo-dark.png" title="" alt="">
                <img class="logo-light" src="assets/img/logo-light.png" title="" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a href="#home" class="nav-link active">{{ __('Start') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#features" class="nav-link">{{ __('Możliwości') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#gallery" class="nav-link">{{ __('Galeria') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#project" class="nav-link">{{ __('Projekt') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">{{ __('Kontakt') }}</a>
                    </li>
                </ul>
                <div class="extra-menu d-none d-lg-block pl-4">
                    <a href="{{ env('APP_PANEL_URL') }}" class="btn btn-login">{{ __('Logowanie') }}</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<section id="home">
    <div class="home-background jarallax">
        <div class="container position-relative">
            <div class="row min-vh-100 align-items-center py-10">
                <div class="col-lg-6 col-xl-5 py-8 mr-auto">
                    <h1 class="display-4 text-white mb-3">{{ __('Hello world...') }}</h1>
                    <p class="lead text-white-50">{{ __('') }}</p>
                    <div class="pt-3">
                        <a class="btn btn-light btn-lg" href="{{ env('APP_PANEL_URL') }}">{{ __('Przejdź do aplikacji') }}</a>
                    </div>
                </div>
{{--                <div class="col-lg-6"></div>--}}
            </div>
        </div>
    </div>
</section>

<section id="features" class="section-dark">
    <div class="container">
        <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
            <div class="col-lg-8">
                <h3 class="h1 after-primary underline pb-3 mb-3">{{ __('Możliwości') }}</h3>
            </div>
        </div>
    </div>
</section>

<section id="gallery" class="section">
    <div class="container">
        <div class="row section-heading justify-content-center text-center">
            <div class="col-lg-8 col-xl-6">
                <h3 class="h1 after-primary underline pb-3 mb-3">{{ __('Galeria') }}</h3>
            </div>
        </div>
    </div>
</section>

<section id="project" class="section-dark">
    <div class="container">
        <div class="row section-heading justify-content-center text-center">
            <div class="col-lg-8 col-xl-6">
                <h3 class="h1 after-primary underline pb-3 mb-3">{{ __('Projekt') }}</h3>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="section jarallax">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-6">
                <h3 class="h1 after-white underline pb-3 mb-3 text-white text-center">{{ __('Pytania?') }}</h3>
                <div class="lead text-white-50">{{ __('') }}</div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded">
                    <h5 class="h6 mb-3">{{ __('Formularz kontaktowy') }}</h5>
                    <form class="rd-mailform" data-form-output="form-output-global" data-form-type="contact"
                          method="post" action="static/vendor/mail/bat/rd-mailform.php" novalidate="novalidate">
                        <div class="form-group mb-3">
                            <input id="contact-name" type="text" name="name" placeholder="{{ __('Imię lub nazwa firmy') }}"
                                   data-constraints="@Required"
                                   class="form-control form-control-sm form-control-has-validation form-control-last-child">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group mb-3">
                            <input id="contact-email" type="email" name="email" placeholder="{{ __('Adres email') }}"
                                   data-constraints="@Required"
                                   class="form-control form-control-sm form-control-has-validation form-control-last-child">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group mb-3">
                            <textarea class="form-control form-control-has-validation form-control-last-child"
                                      id="contact-message" name="message" rows="4" placeholder="{{ __('Twoja wiadomość') }}"
                                      data-constraints="@Required"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-action">
                            <button class="btn btn-md btn-primary" type="submit" name="send">{{ __('Wyślij wiadomość') }}</button>
                            <div class="snackbars" id="form-output-global"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 my-3 mr-auto">
                    <div class="mb-4 text-center">
                        <img class="footer-logo" src="/assets/img/icon.png" title="" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 my-3">
                    <h6>Information</h6>
                    <address>
                        <p class="mb-2">
                            <a class="text-secondary border-bottom border-secondary" href="mailto:support@ezfaktura.pl">support@ezfaktura.pl</a>
                        </p>
                    </address>
                    <div class="nav">
                        <a class="icon icon-sm icon-primary mr-2" href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="icon icon-sm icon-primary mr-2" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="icon icon-sm icon-primary mr-2" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="icon icon-sm icon-primary mr-2" href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 my-3">
                    <h6>Links #1</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-sm-6 my-3">
                    <h6>Links #2</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center text-md-right">
                    <p class="m-0 small">© 2021 copyright all right reserved</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/landing.js"></script>
<script src="assets/js/plugin/jarallax/jarallax.min.js"></script>

</body>
</html>
