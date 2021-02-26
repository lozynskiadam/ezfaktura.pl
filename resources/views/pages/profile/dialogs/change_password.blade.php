<form>
  <div class="form-group row">
    <label for="current_password" class="col-form-label col-md-2">{{ __('translations.profile.change_password.current_password') }}</label>
    <div class="col-md-10">
      <input type="password" id="current_password" class="form-control" name="current_password"/>
    </div>
  </div>
  <div class="form-group row">
    <label for="new_password" class="col-form-label col-md-2">{{ __('translations.profile.change_password.new_password') }}</label>
    <div class="col-md-10">
      <input type="password" id="new_password" class="form-control" name="new_password"/>
    </div>
  </div>
  <div class="form-group row">
    <label for="new_password_confirmation" class="col-form-label col-md-2">{{ __('translations.profile.change_password.repeat_new_password') }}</label>
    <div class="col-md-10">
      <input type="password" id="new_password_confirmation" class="form-control" name="new_password_confirmation"/>
    </div>
  </div>
</form>