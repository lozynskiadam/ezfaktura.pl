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
    <h3 class="text-center">{{ __('translations.login.header') }}</h3>
    <form action="{{ route('app.login') }}" method="POST" class="login-form" autocomplete="off">
      @csrf
      <div class="form-group form-floating-label">
        <input id="email" name="email" type="email" class="form-control input-border-bottom" value="{{ old('email') }}" required>
        <label for="email" class="placeholder">{{ __('translations.login.email') }}</label>
        @if (request()->path() == 'app.login')
          @error('email') <label class="text-danger">{{ $message }}</label> @enderror
        @endif
      </div>
      <div class="form-group form-floating-label">
        <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
        <label for="password" class="placeholder">{{ __('translations.login.password') }}</label>
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
          <label class="custom-control-label" for="rememberme">{{ __('translations.login.remember_me') }}</label>
        </div>
{{--        <a href="javascript:void(0);" class="link float-right">{{ __('translations.login.account_lost') }}</a>--}}
      </div>
      <div class="form-action mb-3">
        <input type="submit" class="btn btn-primary btn-rounded btn-login" value="Login">
      </div>
      <div class="login-account">
        <span class="msg">{{ __('translations.login.new_user') }}</span>
        <a href="javascript:void(0);" id="show-register" class="link">{{ __('translations.register.header') }}</a>
      </div>
    </form>
  </div>

  <div class="container container-register animated fadeIn" @if (request()->path() !== 'app.register') style="display: none;" @endif>
    <h3 class="text-center">{{ __('translations.register.header') }}</h3>
    <form action="{{ route('app.register') }}" method="POST" class="login-form" autocomplete="off">
      @csrf
      <div class="form-group form-floating-label">
        <input id="nip" name="nip" type="text" class="form-control input-border-bottom" maxlength="10" size="10" value="{{ old('nip') }}" required>
        <label for="nip" class="placeholder">{{ __('translations.register.tax_id') }}</label>
        @error('nip') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      <div class="form-group form-floating-label">
        <input id="emailsignin" name="email" type="email" class="form-control input-border-bottom" value="{{ old('email') }}" required>
        <label for="emailsignin" class="placeholder">{{ __('translations.register.email') }}</label>
        @if (request()->path() == 'app.register')
          @error('email') <label class="text-danger">{{ $message }}</label> @enderror
        @endif
      </div>
      <div class="form-group form-floating-label">
        <input id="passwordsignin" name="password" type="password" class="form-control input-border-bottom" required>
        <label for="passwordsignin" class="placeholder">{{ __('translations.register.password') }}</label>
        <div class="show-password">
          <i class="icon-eye"></i>
        </div>
      </div>
      <div class="form-group form-floating-label">
        <input  id="confirmpassword" name="password_confirmation" type="password" class="form-control input-border-bottom" required>
        <label for="confirmpassword" class="placeholder">{{ __('translations.register.confirm_password') }}</label>
        <div class="show-password">
          <i class="icon-eye"></i>
        </div>
        @error('password') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      <div class="form-group form-floating-label">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="agree" value="1" id="agree">
          <label class="custom-control-label" for="agree">
            {{ __('translations.register.accept_terms_of_use_before') }}
            <a href="javascript:void(0);" data-toggle="modal" data-target="#ConditionsModal" class="link">{{ __('translations.register.accept_terms_of_use_link') }}</a>
            {{ __('translations.register.accept_terms_of_use_after') }}</label>
        </div>
        @error('agree') <label class="text-danger">{{ $message }}</label> @enderror
      </div>
      @error('RegistrationError')
        <div class="form-group form-floating-label">
          <label class="text-danger small">{{ $message }}.</label>
        </div>
      @enderror
      <div class="form-action">
        <a href="javascript:void(0);" id="show-login" class="btn btn-link btn-login mr-3"><i class="fa fa-arrow-left"></i> {{ __('translations.register.back') }}</a>
        <input type="submit" class="btn btn-primary btn-rounded btn-login" value="{{ __('translations.register.submit') }}"/>
      </div>
    </form>
  </div>
</div>

<!-- ConditionsModal -->
<div class="modal fade" id="ConditionsModal" tabindex="-1" role="dialog" aria-labelledby="ConditionsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ConditionsLabel">{{ __('translations.login.rules') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="well">
          <h4>1. {{ __('translations.login.rules.general.title') }}</h4>
          <p>
            {{ __('translations.login.rules.general.content') }}
          </p>
          <h4>2. {{ __('translations.login.rules.admin_responsibility.title') }}</h4>
          <p>
            {{ __('translations.login.rules.admin_responsibility.content') }}
          </p>
          <h4>3. {{ __('translations.login.rules.user_responsibilities.title') }}</h4>
          <p>
            {{ __('translations.login.rules.user_responsibilities.content') }}
          </p>
          <h4>4. {{ __('translations.login.rules.changes.title') }}</h4>
          <p>
            {{ __('translations.login.rules.changes.content') }}
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('translations.login.rules.close') }}</button>
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