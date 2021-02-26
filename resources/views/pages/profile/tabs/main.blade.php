<div class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('profile.index') }}" method="POST" autocomplete="off">
          @csrf
          <x-input name="email" :label="__('translations.profile.main.email')" :value="$user->email" disabled/>
          <x-input name="name" :label="__('translations.profile.main.name')" :value="$user->name"/>
          <x-input name="nip" :label="__('translations.profile.main.tax_id')" :value="$user->nip"/>
          <x-input name="address" :label="__('translations.profile.main.address')" :value="$user->address"/>
          <x-input name="postcode" :label="__('translations.profile.main.post_code')" :value="$user->postcode"/>
          <x-input name="city" :label="__('translations.profile.main.city')" :value="$user->city"/>
          <hr class="widget-separator"/>
          <button type="submit" class="btn btn-primary">{{ __('translations.profile.main.save') }}</button>
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
          <button class="btn btn-dark form-control text-white act-upload-logo">
            <i class="fa fa-upload mr-1"></i> {{ __('translations.profile.main.update_logo') }}
          </button>
        </div>

        <hr/>

        <div class="form-group">
          <button class="btn btn-primary form-control btn-round act-change-password">
            <i class="fa fa-lock mr-1"></i> {{ __('translations.profile.main.change_password') }}
          </button>
        </div>
        <div class="form-group">
          <button class="btn btn-primary form-control btn-round act-export-data">
            <i class="fa fa-file-download mr-1"></i> {{ __('translations.profile.main.export_data') }}
          </button>
        </div>
        <div class="form-group">
          <button class="btn btn-danger form-control btn-round act-delete-account">
            <i class="fa fa-times mr-1"></i> {{ __('translations.profile.main.delete_account') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
