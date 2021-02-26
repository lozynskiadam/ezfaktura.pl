<form>
  @if(!count($signatures))
    <div class="alert alert-warning">
      <strong>{{ __('translations.invoices.no_signature_warning.title') }}</strong>
      {{ __('translations.invoices.no_signature_warning.content') }}
      <a href="{{ route('signatures.index') }}">{{ __('translations.invoices.no_signature_warning.button') }}</a>
    </div>
  @endif

  <div class="row">
    <div class="col-md-6 pr-2">
      <table class="table dataTable dataTable-modal">
        <thead>
        <tr>
          <th colspan="2">{{ __('translations.invoices.information') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr class="form-group">
          <td>
            @if(!count($signatures))
              <label class="text-danger"><i class="fa fa-exclamation-triangle"></i> {{ __('translations.invoices.signature') }}</label>
            @else
              <label>{{ __('translations.invoices.signature') }}</label>
            @endif
          </td>
          <td>
            <select class="form-control" name="signature_id">
              @foreach($signatures as $signature)
                <option value="{{ $signature->id }}">{{ $signature->name }}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.issue_date') }}</label>
          </td>
          <td>
            <x-input name="issue_date" value="{{ $issue_date }}"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.sale_date') }}</label>
          </td>
          <td>
            <x-input name="sale_date" value="{{ $sale_date }}"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.payment_due_date') }}</label>
          </td>
          <td>
            <x-input name="payment_due_date" value="{{ $payment_due_date }}"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.payment_method') }}</label>
          </td>
          <td>
            <select class="form-control" name="payment_method">
              @foreach($payment_methods as $payment_method)
                <option value="{{ $payment_method }}">{{ $payment_method }}</option>
              @endforeach
            </select>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.use_discount') }}</label>
          </td>
          <td>
            <select class="form-control" id="use_discount">
              <option value="0">{{ __('translations.common.no') }}</option>
              <option value="1">{{ __('translations.common.yes') }}</option>
            </select>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 pl-2">
      <table class="table dataTable dataTable-modal">
        <thead>
        <tr>
          <th colspan="2">{{ __('translations.invoices.buyer') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.buyer.tax_id') }}</label>
          </td>
          <td style="position: relative;">
            <x-input name="buyer_nip" maxlength="10"/>
            <a href="#" class="addon-gus" data-toggle="tooltip" title="{{ __('translations.invoices.gus_tooltip') }}">
              <i class="fa fa-sign-in-alt fa-rotate-90"></i>GUS
            </a>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.buyer.name') }}</label>
          </td>
          <td>
            <x-input name="buyer_name"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.buyer.address') }}</label>
          </td>
          <td>
            <x-input name="buyer_address"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.buyer.city') }}</label>
          </td>
          <td>
            <x-input name="buyer_city"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('translations.invoices.buyer.post_code') }}</label>
          </td>
          <td>
            <x-input name="buyer_postcode"/>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

  <table class="table dataTable dataTable-modal">
    <thead>
    <tr>
      <th>{{ __('translations.invoices.positions.name') }}</th>
      <th style="width: 40px;">{{ __('translations.invoices.positions.quantity') }}</th>
      <th style="width: 55px;">{{ __('translations.invoices.positions.uom') }}</th>
      <th style="width: 100px;">{{ __('translations.invoices.positions.unit_price') }}</th>
      <th style="width: 45px;">{{ __('translations.invoices.positions.vat') }}</th>
      <th style="width: 60px;">{{ __('translations.invoices.positions.discount') }}</th>
      <th style="width: 5px;"></th>
    </tr>
    </thead>

    <tr class="default-row">
      <td class="form-group">
        <x-input name="%NAME%[name]"/>
      </td>
      <td class="form-group">
        <x-input name="%NAME%[quantity]"/>
      </td>
      <td class="form-group">
        <select class="form-control" name="%NAME%[unit]">
          @foreach($units_of_measure as $unit_of_measure)
            <option value="{{ $unit_of_measure }}">{{ $unit_of_measure }}</option>
          @endforeach
        </select>
      </td>
      <td class="form-group">
        <x-input name="%NAME%[price]"/>
      </td>
      <td class="form-group">
        <select class="form-control" name="%NAME%[tax_rate]">
          @foreach($vat_rates as $vat_rate)
            <option value="{{ $vat_rate }}">{{ $vat_rate }}%</option>
          @endforeach
        </select>
      </td>
      <td class="form-group">
        <x-input name="%NAME%[discount]"/>
      </td>
      <td class="text-center">
        <a href="#" class="%BTN_CLASS%"><i class="%BTN_ICON%"></i></a>
      </td>
    </tr>

  </table>
</form>