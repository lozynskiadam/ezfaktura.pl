<form>
  <div class="row">
    <div class="col-md-6 pr-2">
      <table class="table dataTable dataTable-modal">
        <thead>
        <tr>
          <th colspan="2">{{ __('Informacje') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr class="form-group">
          <td>
            <label>{{ __('Sygnatura') }}</label>
          </td>
          <td>
            <select class="form-control" name="signature">
              <option value="default">domyślna</option>
            </select>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Data wystawienia') }}</label>
          </td>
          <td>
            <x-input name="issue_date" value="{{ $issue_date }}"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Data sprzedaży') }}</label>
          </td>
          <td>
            <x-input name="sale_date" value="{{ $sale_date }}"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Data dostawy') }}</label>
          </td>
          <td>
            <x-input name="delivery_date" value="{{ $delivery_date }}"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Termin płatności') }}</label>
          </td>
          <td>
            <x-input name="payment_due_date"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Metoda płatności') }}</label>
          </td>
          <td>
            <x-input name="payment_method"/>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 pl-2">
      <table class="table dataTable dataTable-modal">
        <thead>
        <tr>
          <th colspan="2">{{ __('Nabywca') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr class="form-group">
          <td>
            <label>{{ __('NIP') }}</label>
          </td>
          <td style="position: relative;">
            <x-input name="buyer_nip" maxlength="10"/>
            <a href="#" class="addon-gus" data-toggle="tooltip" title="{{ __('Uzupełnij pole NIP po czym kliknij ten przycisk aby pobrać dane zarejestrowanie w GUSie') }}">
              <i class="fa fa-sign-in-alt fa-rotate-90"></i>GUS
            </a>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Nazwa') }}</label>
          </td>
          <td>
            <x-input name="buyer_name"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Adres') }}</label>
          </td>
          <td>
            <x-input name="buyer_address"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Miasto') }}</label>
          </td>
          <td>
            <x-input name="buyer_city"/>
          </td>
        </tr>
        <tr class="form-group">
          <td>
            <label>{{ __('Kod pocztowy') }}</label>
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
      <th>{{ __('Nazwa') }}</th>
      <th style="width: 40px;">{{ __('Ilość') }}</th>
      <th style="width: 55px;">{{ __('JM') }}</th>
      <th style="width: 100px;">{{ __('Cena jedn.') }}</th>
      <th style="width: 45px;">{{ __('VAT') }}</th>
      <th style="width: 60px;">{{ __('Rabat') }}</th>
      <th style="width: 5px;"></th>
    </tr>
    </thead>
    <tr>
      <td class="form-group">
        <x-input name="positions[1][name]"/>
      </td>
      <td class="form-group">
        <x-input name="positions[1][quantity]"/>
      </td>
      <td class="form-group">
        <select class="form-control" name="positions[1][unit]">
          <option value="szt">szt</option>
          <option value="kg">kg</option>
          <option value="godz">godz</option>
        </select>
      </td>
      <td class="form-group">
        <x-input name="positions[1][price]"/>
      </td>
      <td class="form-group">
        <select class="form-control" name="positions[1][tax_rate]">
          <option value="23">23%</option>
          <option value="8">8%</option>
          <option value="5">5%</option>
          <option value="0">0%</option>
          <option value="0">zw</option>
        </select>
      </td>
      <td class="form-group">
        <x-input name="positions[1][discount]"/>
      </td>
      <td class="text-center">
        <a href="#"><i class="fa fa-plus"></i></a>
      </td>
    </tr>
  </table>
</form>