<div class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('profile.index') }}" method="POST" autocomplete="off">
          @csrf
          <x-input name="email" :label="__('Adres email')" :value="$user->email" disabled/>
          <x-input name="name" :label="__('Nazwa firmy')" :value="$user->name"/>
          <x-input name="nip" :label="__('NIP')" :value="$user->nip"/>
          <x-input name="address" :label="__('Adres firmy')" :value="$user->address"/>
          <x-input name="postcode" :label="__('Kod pocztowy')" :value="$user->postcode"/>
          <x-input name="city" :label="__('Miasto')" :value="$user->city"/>
          <hr class="widget-separator"/>
          <button type="submit" class="btn btn-primary">{{ __('Zapisz zmiany') }}</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <div class="profile-image">
            <span></span>
            <img id="Logo" src="{{ $user->logo }}"/>
          </div>
          <button id="UploadLogo" class="btn btn-dark form-control text-white">
            <i class="fa fa-upload mr-1"></i> {{ __('Aktualizuj logo') }}
          </button>
        </div>

        <hr/>

        <div class="form-group">
          <button class="btn btn-primary form-control btn-round">
            <i class="fa fa-file-export mr-1"></i> {{ __('Eksportuj swoje dane') }}
          </button>
        </div>
        <div class="form-group">
          <button class="btn btn-danger form-control btn-round">
            <i class="fa fa-times mr-1"></i> {{ __('Usuń konto') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
