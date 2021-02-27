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
        <img class="logo-color" src="{{ asset('assets/img/logo-color.png') }}" title="" alt="">
        <img class="logo-white" src="{{ asset('assets/img/logo-white.png') }}" title="" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
              aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav m-auto">
          <li class="nav-item">
            <a href="#home" class="nav-link active">{{ __('translations.home.menu.home') }}</a>
          </li>
          <li class="nav-item">
            <a href="#features" class="nav-link">{{ __('translations.home.menu.features') }}</a>
          </li>
          <li class="nav-item">
            <a href="#project" class="nav-link">{{ __('translations.home.menu.project') }}</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link">{{ __('translations.home.menu.contact') }}</a>
          </li>
        </ul>
        <div class="extra-menu d-none d-lg-block pl-4">
          <a href="{{ env('APP_PANEL_URL') }}" class="btn btn-login">{{ __('translations.home.menu.login') }}</a>
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
          <h1 class="display-4 text-white mb-3">{{ __('translations.home.start.header') }}</h1>
          <p class="lead text-white-50">{{ __('translations.home.start.subheader') }}</p>
          <div class="pt-3">
            <a class="btn btn-light btn-lg" href="{{ env('APP_PANEL_URL') }}">{{ __('translations.home.start.enter_application') }}</a>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <img draggable="false" src="/assets/img/screen.png"/>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="features">
<section class="section-dark sep-dl">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <div class="feature feature-1 text-center">
          <i class="fas fa-university text-secondary m-3"></i>
          <h5>{{ __('translations.home.features.gus.title') }}</h5>
          <p>{{ __('translations.home.features.gus.description') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="feature feature-1 text-center">
          <i class="fa fa-file-invoice-dollar text-secondary m-3"></i>
          <h5>{{ __('translations.home.features.templates.title') }}</h5>
          <p>{{ __('translations.home.features.templates.description') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="feature feature-1 text-center">
          <i class="fa fa-chart-line text-secondary m-3"></i>
          <h5>{{ __('translations.home.features.reports.title') }}</h5>
          <p>{{ __('translations.home.features.reports.description') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="feature feature-1 text-center">
          <i class="fa fa-book-open text-secondary m-3"></i>
          <h5>{{ __('translations.home.features.white_list.title') }}</h5>
          <p>{{ __('translations.home.features.white_list.description') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="feature feature-1 text-center">
          <i class="fa fa-sliders-h text-secondary m-3"></i>
          <h5>{{ __('translations.home.features.parameters.title') }}</h5>
          <p>{{ __('translations.home.features.parameters.description') }}</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="feature feature-1 text-center">
          <i class="fa fa-mobile-alt text-secondary m-3"></i>
          <h5>{{ __('translations.home.features.devices.title') }}</h5>
          <p>{{ __('translations.home.features.devices.description') }}</p>
        </div>
      </div>
    </div>

  </div>
</section>

<section class="section sep-ld">
  <div class="container">

    <div class="row">
      <div class="col-md-6 pt-1 text-center">
        <img src="{{ asset('assets/img/gif-1.gif') }}" style="max-width: 100%; pointer-events: none; user-select: none;"/>
      </div>
      <div class="col-md-6">
        <h2 class="font-w-700 dark-color mb-1">{{ __('translations.home.templates.title') }}<span class="text-primary">!</span></h2>

        <table class="table">
          <tr>
            <td class="border-0 px-0 py-3" style="width: 35px;">
              <i class="fa fa-angle-double-right fa-2x text-primary pt-1"></i>
            </td>
            <td class="border-0 py-3">
              <strong>{{ __('translations.home.templates.design.title') }}</strong><br/>
              {{ __('translations.home.templates.design.description') }}
            </td>
          </tr>
          <tr>
            <td class="px-0 py-3" style="width: 35px;">
              <i class="fa fa-angle-double-right fa-2x text-primary pt-1"></i>
            </td>
            <td class="py-3">
              <strong>{{ __('translations.home.templates.colors.title') }}</strong><br/>
              {{ __('translations.home.templates.colors.description') }}
            </td>
          </tr>
          <tr>
            <td class="px-0 py-3" style="width: 35px;">
              <i class="fa fa-angle-double-right fa-2x text-primary pt-1"></i>
            </td>
            <td class="py-3">
              <strong>{{ __('translations.home.templates.logo.title') }}</strong><br/>
              {{ __('translations.home.templates.logo.description') }}
            </td>
          </tr>
          <tr>
            <td class="px-0 py-3" style="width: 35px;">
              <i class="fa fa-angle-double-right fa-2x text-primary pt-1"></i>
            </td>
            <td class="py-3">
              <strong>{{ __('translations.home.templates.positions.title') }}</strong><br/>
              {{ __('translations.home.templates.positions.description') }}
            </td>
          </tr>
        </table>
      </div>
    </div>

  </div>
</section>
</div>

<section id="project" class="section-dark">
  <div class="container">

    <div class="row">
      <div class="col-md-12 offset-lg-4 col-lg-4 my-5">
        <div class="hover-top-in text-center">
          <div class="avatar">
            <img src="{{ asset('assets/img/logo-default.png') }}"/>
          </div>
          <div class="shadow rounded-3 position-relative bg-white  text-center p-4 pt-6 mt-n4">
            <h6 class="font-w-700 dark-color mb-1" style="font-size: 1.2rem;">Adam Łożyński</h6>
            <small>Developer</small>
            <div class="pt-2">
              <a class="icon icon-sm icon-primary rounded-circle me-1" href="https://facebook.com/nemnes">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a class="icon icon-sm icon-primary rounded-circle me-1" href="https://www.linkedin.com/in/adam-%C5%82o%C5%BCy%C5%84ski-6336361b8/">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a class="icon icon-sm icon-primary rounded-circle me-1" href="https://github.com/lozynskiadam">
                <i class="fab fa-github"></i>
              </a>
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
        <h3 class="h1 after-white underline pb-3 mb-3 text-white text-center">{{ __('translations.home.contact.title') }}</h3>
        <div
          class="lead text-white-50">{{ __('translations.home.contact.description') }}</div>
      </div>
      <div class="col-md-4">

        <div class="p-4">
          <form id="contact-form" action="" method="post">
            <div class="form-group mb-3">
              <label for="contact-name">{{ __('translations.home.contact.form.name') }}</label>
              <input id="contact-name" type="text" name="name" class="form-control" required>
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-group mb-3">
              <label for="contact-email">{{ __('translations.home.contact.form.email') }}</label>
              <input id="contact-email" type="email" name="email" class="form-control" required>
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-group mb-3">
              <label for="message">{{ __('translations.home.contact.form.message') }}</label>
              <textarea id="contact-message" name="content" rows="4" class="form-control" required></textarea>
              <span class="invalid-feedback"></span>
            </div>
            <div class="form-action">
              <button id="contact-submit" class="btn btn-primary" type="submit" name="send">{{ __('translations.home.contact.form.send') }}</button>
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
          <h6>{{ __('translations.home.footer.application') }}</h6>
          <ul class="list-unstyled">
            <li><a href="#home">{{ __('translations.home.menu.home') }}</a></li>
            <li><a href="#features">{{ __('translations.home.menu.features') }}</a></li>
            <li><a href="#project">{{ __('translations.home.menu.project') }}</a></li>
            <li><a href="#contact">{{ __('translations.home.menu.contact') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
          <h6>{{ __('translations.home.footer.useful') }}</h6>
          <ul class="list-unstyled">
            <li><a href="#">{{ __('translations.home.footer.terms_of_use') }}</a></li>
            <li><a href="#">{{ __('translations.home.footer.privacy_policy') }}</a></li>
            <li><a href="#">{{ __('translations.home.footer.cookies') }}</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
          <h6>{{ __('translations.home.footer.contact') }}</h6>
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
