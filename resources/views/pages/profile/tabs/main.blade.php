<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">{{ __('Informacje ogólne') }}</div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">

              <div class="form-group">
                <div class="profile-image">
                  <span></span>
                  <img src="./assets/img/profile.png"/>
                </div>
                <button class="btn btn-dark form-control"><i class="fa fa-upload mr-1"></i> {{ __('Aktualizuj logo') }}</button>
              </div>

              <hr/>

              <div class="form-group">
                <button class="btn btn-primary  form-control btn-round"><i class="fa fa-file-export mr-1"></i> {{ __('Eksportuj swoje dane') }}</button>
              </div>
              <div class="form-group">
                <button class="btn btn-danger form-control btn-round"><i class="fa fa-times mr-1"></i> {{ __('Usuń konto') }}</button>
              </div>

            </div>
            <div class="col-md-9">

              <div class="form-group">
                <label for="name">{{ __('Nazwa firmy') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
              </div>

              <div class="form-group">
                <label for="nip">{{ __('NIP') }}</label>
                <input type="text" class="form-control" id="nip" name="nip" value="{{ $user->nip }}"/>
              </div>

              <div class="form-group">
                <label for="email">{{ __('Adres email') }}</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}"/>
              </div>

              <div class="form-group">
                <label for="address">{{ __('Adres firmy') }}</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}"/>
              </div>

              <div class="form-group">
                <label for="postcode">{{ __('Kod pocztowy') }}</label>
                <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $user->postcode }}"/>
              </div>

              <div class="form-group">
                <label for="city">{{ __('Miasto') }}</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}"/>
              </div>

              <div class="form-group">
                <button class="btn btn-primary">{{ __('Zapisz') }}</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>