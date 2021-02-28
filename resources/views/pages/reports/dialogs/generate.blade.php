<form>

  <div class="form-group row">
    <label for="name" class="col-form-label col-md-2">{{ __('translations.reports.date_from') }}</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="date_from" name="date_from" value="{{ $date_from }}">
    </div>
  </div>

  <div class="form-group row">
    <label for="name" class="col-form-label col-md-2">{{ __('translations.reports.date_to') }}</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="date_to" name="date_to" value="{{ $date_to }}">
    </div>
  </div>

</form>