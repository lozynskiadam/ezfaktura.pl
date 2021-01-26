<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <title>{{ env('APP_NAME') }}</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport'/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('/assets/img/icon.png') }}" type="image/png"/>

  <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/atlantis.css') }}">
  <link rel="stylesheet" href="{{ asset('/assets/css/ezfaktura.css') }}">

  <!-- Fonts and icons -->
  <script src="{{ asset('/assets/js/plugin/webfont/webfont.min.js') }}"></script>
  <script>
    WebFont.load({
      google: {"families": ["Lato:300,400,700,900", "Khand:300,400,500,600,700"]},
      custom: {
        "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
        urls: ['/assets/css/fonts.min.css']
      },
      active: function () {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <script src="/assets/js/app.js"></script>
</head>
<body>
<div class="wrapper">
  <div class="main-header">

    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">
      <a href="{{ route('home') }}" class="logo">
        <img src="/assets/img/logo.png" alt="navbar brand" class="navbar-brand">
      </a>
      <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <i class="icon-menu"></i>
        </span>
      </button>
      <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar"><i class="icon-menu"></i></button>
      </div>
    </div>
    <!-- End Logo Header -->

    @include('layouts.navbar')
  </div>

  @include('layouts.sidebar')

  <div class="main-panel">
    <div class="content">
      @yield('content')
    </div>
    @include('layouts.footer')
  </div>

</div>

<!-- Core JS Files -->
<script src="{{ asset('/assets/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Datepicker -->
<script src="{{ asset('/assets/js/plugin/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugin/datepicker/locales/pl.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/assets/js/plugin/datepicker/bootstrap-datepicker3.min.css') }}"/>

<!-- Datatables -->
<script src="{{ asset('/assets/js/plugin/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugin/datatables/dataTables.buttons.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/assets/js/plugin/datatables/buttons.dataTables.min.css') }}">
<script src="{{ asset('/assets/js/renderers.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Atlantis JS -->
<script src="{{ asset('/assets/js/atlantis.js') }}"></script>

<!-- Dialog -->
<script src="{{ asset('/assets/js/plugin/dialog/dialog.js') }}"></script>

@yield('scripts')

<script>
  $(document).ready(function () {
    App.init();
  });
</script>

</body>
</html>
