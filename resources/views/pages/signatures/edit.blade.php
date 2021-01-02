<form>
  <div class="form-group row">
    <label for="name" class="col-form-label col-md-2">{{ __('ID') }}</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="name" name="name" value="{{ $signature->name ?? '' }}" autocomplete="off">
    </div>
  </div>
  <div class="form-group row">
    <label for="syntax" class="col-form-label col-md-2">{{ __('Składnia') }}</label>
    <div class="col-md-10">
      <input type="text" class="form-control" id="syntax" name="syntax" value="{{ $signature->syntax ?? '' }}" autocomplete="off" placeholder="FV/{year}/{month}/{counter}">
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-form-label col-md-2">{{ __('Opis') }}</label>
    <div class="col-md-10">
      <textarea class="form-control" id="description" name="description">{{ $signature->description ?? '' }}</textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="mode" class="col-form-label col-md-2">{{ __('Licznik') }}</label>
    <div class="col-md-10">
      <select id="mode" class="form-control" name="mode">
        <option value="monthly" @if(isset($signature->mode) && $signature->mode == 'monthly') selected @endif >{{ __('Miesięczny') }}</option>
        <option value="yearly" @if(isset($signature->mode) && $signature->mode == 'yearly') selected @endif >{{ __('Roczny') }}</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-form-label col-md-2">{{ __('Typy faktur') }}</label>
    <div class="col-md-10">
      <div class="selectgroup selectgroup-pills">
        @foreach($invoice_types as $invoice_type)
          <label class="selectgroup-item" data-toggle="tooltip" title="{{ $invoice_type->name }}">
            <input type="checkbox" name="invoice_types[]" value="{{ $invoice_type->id }}" class="selectgroup-input"
            @foreach($signature->invoice_types ?? [] as $s_invoice_type)
              @if ($s_invoice_type->id == $invoice_type->id) checked @endif
            @endforeach
            >
            <span class="selectgroup-button">{{ $invoice_type->initials }}</span>
          </label>
        @endforeach
      </div>
      <div class="validation-block"></div>
    </div>
  </div>
</form>