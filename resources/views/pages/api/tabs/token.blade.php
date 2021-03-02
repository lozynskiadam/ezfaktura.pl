<div class="row">
  <div class="offset-md-3 col-md-6 mt-4 text-center">
    <div class="alert alert-warning">
      <p><i class="fa fa-exclamation-triangle fa-4x text-warning"></i></p>
      <p>{{ __('translations.api.token.warning_1') }}</p>
      <p>{{ __('translations.api.token.warning_2') }}</p>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">{{ __('translations.api.token.your_token') }}:</span>
      </div>
      <input id="api-token" type="password" class="form-control" value="{{ $token }}" readonly>
      <div class="input-group-append">
        <button class="btn btn-primary act-toggle-token" type="button"><i class="fa fa-eye"></i></button>
      </div>
    </div>
    <button class="btn btn-danger act-reset-token" type="button">{{ __('translations.api.token.reset_token') }}</button>
  </div>
</div>