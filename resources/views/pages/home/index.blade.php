<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title>{{ env('APP_NAME') }}</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('assets/img/icon.png') }}" type="image/png"/>
  <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
  <script>
    WebFont.load({
      google: {"families": ["Lato:300,400,700,900"]},
      custom: {
        "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
        urls: ['{{ asset('/assets/css/fonts.min.css') }}']
      },
      active: function () {
        sessionStorage.fonts = true;
      }
    });
  </script>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>
<body>

<!-- Preload -->
<div id="loading" class="preloader">
  <div class="spinner" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<!-- End Preload -->

<header class="header-main fixed-top navbar-dark">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#home">
        <img class="logo-dark" src="{{ asset('assets/img/logo-dark.png') }}" title="" alt="">
        <img class="logo-light" src="{{ asset('assets/img/logo-light.png') }}" title="" alt="">
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
            <a href="#media" class="nav-link">{{ __('Media') }}</a>
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
        <div class="col-lg-6 col-xl-5 col-sm-12 py-8 mr-auto">
          <h1 class="display-4 text-white mb-3">{{ __('Już łatwiej się nie da...') }}</h1>
          <p
            class="lead text-white-50">{{ __('Załóż bezpłatne konto i przekonaj się o możliwościach naszej aplikacji już teraz!') }}</p>
          <div class="pt-3">
            <a class="btn btn-light btn-lg" href="{{ env('APP_PANEL_URL') }}">{{ __('Przejdź do aplikacji') }}</a>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <img src="/assets/img/screen.png"/>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="features" class="section-dark sep-dl">
  <div class="container">
    <div class="row md-m-25px-b m-45px-b justify-content-center text-center">
      <div class="col-lg-8">
        <h3 class="h1 after-primary underline pb-3 mb-3">{{ __('Możliwości') }}</h3>
      </div>
    </div>
    <div class="row my-5">
      <div class="col-sm-4">
        <div class="feature feature-1 text-center">
          <i class="fas fa-university text-secondary m-3"></i>
          <h5>{{ __('INTEGRACJA Z GUSEM') }}</h5>
          <p>{{ __('Dzięki integracji z urzędem centralnym administracji rządowej aktualne dane kontrahentów pobierzesz automatycznie — wystarczy NIP.') }}</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="feature feature-1 text-center">
          <i class="fa fa-file-invoice-dollar text-secondary m-3"></i>
          <h5>{{ __('KONFIGUROWALNE SZABLONY') }}</h5>
          <p>{{ __('Aplikacja wyposażona jest w moduł personalizacji szablonów faktur, dzięki czemu wystawiany dokument wyglądać będzie dokładnie tak jak chcesz.') }}</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="feature feature-1 text-center">
          <i class="fa fa-chart-line text-secondary m-3"></i>
          <h5>{{ __('SZCZEGÓŁOWE RAPORTY') }}</h5>
          <p>{{ __('Aplikacja oferuje możliwość błyskawicznego wygenerowania szeregu różnych zestawień, podsumowań oraz raportów finansowych.') }}</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="feature feature-1 text-center">
          <i class="fa fa-book-open text-secondary m-3"></i>
          <h5>{{ __('BIAŁA KSIĘGA') }}</h5>
          <p>{{ __('Integracja z białą księgą pozwala na automatyczną weryfikację rachunków bankowych oraz statusu VAT Twoich kontrahentów.') }}</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="feature feature-1 text-center">
          <i class="fa fa-sliders-h text-secondary m-3"></i>
          <h5>{{ __('PEŁNA PARAMETRYZACJA') }}</h5>
          <p>{{ __('Aby doznania z użytkowania aplikacji były jak najlepsze zapewniamy szeroką gamę parametrów konfiguracyjnych i użytkowych.') }}</p>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="feature feature-1 text-center">
          <i class="fa fa-mobile-alt text-secondary m-3"></i>
          <h5>{{ __('DZIAŁA NA KAŻDYM URZĄDZENIU') }}</h5>
          <p>{{ __('Naszą aplikację uruchomisz zarówno na komputerze stacjonarnym, jak i każdym urządzeniu obsługującym przeglądarkę internetową.') }}</p>
        </div>
      </div>
    </div>

  </div>
</section>

<section id="media" class="section sep-ld">
  <div class="container">
    <div class="row section-heading justify-content-center text-center">
      <div class="col-lg-8 col-xl-6">
        <h3 class="h1 after-primary underline pb-3 mb-3">{{ __('Media') }}</h3>
      </div>
    </div>
  </div>
</section>

<section id="project" class="section-dark">
  <div class="container">
    <div class="row section-heading justify-content-center text-center">
      <div class="col-lg-8 col-xl-6">
        <h3 class="h1 after-primary underline pb-3 mb-3">{{ __('Projekt') }}</h3>
        <div
          class="lead">{{ __('ezFaktura to jednoosobowa i niekomercyjna aplikacja utworzona wyłącznie w celach pokazowych. Mimo to wciąż jest w pełni funkcjonalnym produktem zawierającym wszystkie wyżej wymienione moduły.') }}</div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 offset-lg-4 col-lg-4 my-5">
        <div class="hover-top-in text-center">
          <div class="avatar">
            <img src="{{ asset('assets/img/logo-default.png') }}"/>
          </div>
          <div class="mx-2 mx-xl-3 shadow rounded-3 position-relative mt-n4 bg-white p-4 pt-6 mx-4 text-center">
            <h6 class="font-w-700 dark-color mb-1" style="font-size: 1.2rem;">Adam Łożyński</h6>
            <small>{{ __('Developer') }}</small>
            <div class="pt-2">
              <a class="icon icon-sm icon-primary rounded-circle me-1" href="https://facebook.com/nemnes"><i
                  class="fab fa-facebook-f"></i></a>
              <a class="icon icon-sm icon-primary rounded-circle me-1"
                 href="https://www.linkedin.com/in/adam-%C5%82o%C5%BCy%C5%84ski-6336361b8/"><i
                  class="fab fa-linkedin-in"></i></a>
              <a class="icon icon-sm icon-primary rounded-circle me-1" href="https://github.com/lozynskiadam"><i
                  class="fab fa-github"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<section id="contact" class="section jarallax">
  <div class="container">
    <div class="row justify-content-center align-items-center">

      <div class="col-md-6">
        <h3 class="h1 after-white underline pb-3 mb-3 text-white text-center">{{ __('Pytania?') }}</h3>
        <div
          class="lead text-white-50">{{ __('Skorzystaj z formularza kontaktowego i wyślij nam wiadomość. Odpowiedzi postaramy się udzielić najszybciej jak będzie to możliwe') }}</div>
      </div>
      <div class="col-md-4">

        <div class="p-4">
          <form id="contact-form" action="" method="post">
            <div class="form-group mb-3">
              <label for="contact-name">{{ __('IMIĘ LUB NAZWA FIRMY') }}</label>
              <input id="contact-name" type="text" name="name" class="form-control" required>
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-group mb-3">
              <label for="contact-email">{{ __('ADRES EMAIL') }}</label>
              <input id="contact-email" type="email" name="email" class="form-control" required>
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-group mb-3">
              <label for="message">{{ __('TWOJA WIADOMOŚĆ') }}</label>
              <textarea id="contact-message" name="message" rows="4" class="form-control" required></textarea>
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-action">
              <button id="contact-submit" class="btn btn-primary" type="submit" name="send">{{ __('Wyślij wiadomość') }}</button>
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
            <img class="footer-logo" src="/assets/img/logo.png">
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
          <h6>{{ __('Aplikacja') }}</h6>
          <ul class="list-unstyled">
            <li><a href="#home">{{ __('Start') }}</a></li>
            <li><a href="#features">{{ __('Możliwości') }}</a></li>
            <li><a href="#project">{{ __('Projekt') }}</a></li>
            <li><a href="#contact">{{ __('Kontakt') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
          <h6>{{ __('Użyteczne') }}</h6>
          <ul class="list-unstyled">
            <li><a href="#">{{ __('Warunki użytkowania') }}</a></li>
            <li><a href="#">{{ __('Polityka prywatności') }}</a></li>
            <li><a href="#">{{ __('Pliki cookie') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
          <h6>{{ __('Kontakt') }}</h6>
          <address>
            <p class="mb-2">
              <a class="text-secondary border-bottom border-secondary" href="mailto:support@ezfaktura.pl">support@ezfaktura.pl</a>
            </p>
          </address>
          <div class="nav">
            <a class="icon icon-sm icon-disabled mr-2" href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="icon icon-sm icon-disabled mr-2" href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="icon icon-sm icon-disabled mr-2" href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a class="icon icon-sm icon-disabled mr-2" href="#">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
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

<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/landing.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jarallax/jarallax.min.js') }}"></script>

</body>
</html>
