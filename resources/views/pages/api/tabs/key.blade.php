<div class="row">
  <div class="offset-md-3 col-md-6 mt-4 text-center">
    <div class="alert alert-warning">
      <p><i class="fa fa-exclamation-triangle fa-4x text-warning"></i></p>
      <p>{{ __('Klucz API to unikalny identyfikator używany do uwierzytelniania użytkownika. Przejęcie klucza przez
              nieuprawnione osoby może prowadzić do wykonania serii operacji z Twojego konta, a co za tym idzie do wycieku
              lub całkowitej utraty danych zarówno Twoich jak i Twoich kontrahentów.') }}</p>
      <p>{{ __('Jeżeli podejrzewasz, że niepowołana osoba uzyskała dostęp do klucza niezwłocznie go zresetuj!') }}</p>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">{{ __('Twój klucz do API') }}:</span>
      </div>
      <input id="ApiKey" type="password" class="form-control" value="{{ $key }}" readonly>
      <div class="input-group-append">
        <button class="btn btn-primary act-toggle-key" type="button"><i class="fa fa-eye"></i></button>
      </div>
    </div>
    <button class="btn btn-danger act-reset-key" type="button">{{ __('Zresetuj klucz') }}</button>
  </div>
</div>