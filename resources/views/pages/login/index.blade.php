<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>{{ env('APP_NAME') }}</title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="icon" href="assets/img/icon.png" type="image/png"/>

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Lato:300,400,700,900"]},
      custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/css/fonts.min.css']},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="login">
<div class="wrapper wrapper-login">
  <div class="container container-login animated fadeIn" @if (request()->path() !== 'login') style="display: none;" @endif>
    <h3 class="text-center">{{ __('Logowanie') }}</h3>
    <form action="{{ route('login') }}" method="POST" class="login-form" autocomplete="off">
      @csrf
      <div class="form-group form-floating-label">
        <input id="email" name="email" type="email" class="form-control input-border-bottom" value="{{ old('email') }}" required>
        <label for="email" class="placeholder">{{ __('Email') }}</label>
        @if (request()->path() == 'login')
          @error('email') <label class="text-danger">{{ $message }}</label> @enderror
        @endif
      </div>
      <div class="form-group form-floating-label">
        <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
        <label for="password" class="placeholder">{{ __('Hasło') }}</label>
        <div class="show-password">
          <i class="icon-eye"></i>
        </div>
        @error('password') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      @error('LoginError')
        <div class="form-group form-floating-label">
          <label class="text-danger small">{{ $message }}.</label>
        </div>
      @enderror
      <div class="row form-sub m-0">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="rememberme" name="remember">
          <label class="custom-control-label" for="rememberme">{{ __('Zapamiętaj mnie') }}</label>
        </div>
{{--        <a href="javascript:void(0);" class="link float-right">{{ __('Zapomniałeś hasła?') }}</a>--}}
      </div>
      <div class="form-action mb-3">
        <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Login">
      </div>
      <div class="login-account">
        <span class="msg">{{ __('Nie masz jeszcze konta?') }}</span>
        <a href="javascript:void(0);" id="show-register" class="link">{{ __('Rejestracja') }}</a>
      </div>
    </form>
  </div>

  <div class="container container-register animated fadeIn" @if (request()->path() !== 'register') style="display: none;" @endif>
    <h3 class="text-center">{{ __('Rejestracja') }}</h3>
    <form action="{{ route('register') }}" method="POST" class="login-form" autocomplete="off">
      @csrf
      <div class="form-group form-floating-label">
        <input id="nip" name="nip" type="text" class="form-control input-border-bottom" maxlength="10" size="10" value="{{ old('nip') }}" required>
        <label for="nip" class="placeholder">{{ __('NIP') }}</label>
        @error('nip') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      <div class="form-group form-floating-label">
        <input id="emailsignin" name="email" type="email" class="form-control input-border-bottom" value="{{ old('email') }}" required>
        <label for="emailsignin" class="placeholder">{{ __('Email') }}</label>
        @if (request()->path() == 'register')
          @error('email') <label class="text-danger">{{ $message }}</label> @enderror
        @endif
      </div>
      <div class="form-group form-floating-label">
        <input id="passwordsignin" name="password" type="password" class="form-control input-border-bottom" required>
        <label for="passwordsignin" class="placeholder">{{ __('Hasło') }}</label>
        <div class="show-password">
          <i class="icon-eye"></i>
        </div>
      </div>
      <div class="form-group form-floating-label">
        <input  id="confirmpassword" name="password_confirmation" type="password" class="form-control input-border-bottom" required>
        <label for="confirmpassword" class="placeholder">{{ __('Potwierdź hasło') }}</label>
        <div class="show-password">
          <i class="icon-eye"></i>
        </div>
        @error('password') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      <div class="form-group form-floating-label">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="agree" value="1" id="agree">
          <label class="custom-control-label" for="agree">
            {{ __('Akceptuję') }}
            <a href="javascript:void(0);" data-toggle="modal" data-target="#ConditionsModal" class="link">{{ __('warunki') }}</a>
            {{ __('korzystania z serwisu') }}</label>
        </div>
        @error('agree') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      @error('RegistrationError')
        <div class="form-group form-floating-label">
          <label class="text-danger small">{{ $message }}.</label>
        </div>
      @enderror
      <div class="form-action">
        <a href="javascript:void(0);" id="show-login" class="btn btn-link btn-login mr-3"><i class="fa fa-arrow-left"></i> {{ __('Wróć') }}</a>
        <input type="submit" class="btn btn-primary btn-rounded btn-login" value="{{ __('Załóż konto') }}"/>
      </div>
    </form>
  </div>
</div>

<!-- ConditionsModal -->
<div class="modal fade" id="ConditionsModal" tabindex="-1" role="dialog" aria-labelledby="ConditionsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ConditionsLabel">{{ __('Regulamin serwisu ezFaktura.pl') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="well">
          <h4>{{ __('1. Warunki ogólne') }}</h4>
          <p>
            {{ __('Niniejszy regulamin określa warunki korzystania oraz funkcjonowania, a także prawa i obowiązki użytkowników oraz obowiązki i zakres odpowiedzialności administracji serwisu znajdującego się pod adresem www.ezfaktura.pl. Uzyskując dostęp i rejestrując się w serwisie ezFaktura.pl potwierdzasz, że zgadzasz się z warunkami zawartymi w regulaminie.') }}
          </p>
          <h4>{{ __('2. Odpowiedzialność administratora serwisu') }}</h4>
          <p>
            {{ __('Serwis ezFaktura.pl został uruchomiony jako aplikacja pokazowa. Nie ponosimy odpowiedzialności za wszelkie błędy w działaniu aplikacji.') }}
          </p>
          <h4>{{ __('3. Obowiązki użytkownika') }}</h4>
          <p>
            {{ __('W trakcie procesu rejestracji użytkownik zobowiązany jest do podania numeru identyfikacji podatkowej, adresu email oraz hasła. Podane hasło musi być unikalne nie może być używane w żadnej innej aplikacji.') }}
          </p>
          <h4>{{ __('4. Zmiany w regulaminie') }}</h4>
          <p>
            {{ __('Jeśli zmienimy nasze warunki użytkowania, opublikujemy te zmiany na tej stronie. Treść regulaminu jest dostępna w serwisie i może zostać w każdym momencie zapisana na nośniku bądź wydrukowana.') }}
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Zamknij') }}</button>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/atlantis.js"></script>

</body>
</html>