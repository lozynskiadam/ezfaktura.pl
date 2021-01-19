<style>
  table.dataTable-modal {
    margin-top: 0 !important;
  }
  table.dataTable-modal th {
    padding: 5px;
  }
  table.dataTable-modal td {
    padding: 0 !important;
    height: 30px !important;
  }
  table.dataTable-modal td input,
  table.dataTable-modal td select {
    padding: 5px;
    border-radius: 0;
  }
</style>
<form>
  <div class="row">
    <div class="col-md-6 pr-2">
      <table class="table dataTable dataTable-modal">
        <thead>
        <tr>
          <th colspan="2">{{ __('Sprzedawca') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{ __('Nazwa') }}</td>
          <td>{{ $user->name }}</td>
        </tr>
        <tr>
          <td>{{ __('Adres') }}</td>
          <td>{{ $user->address }}</td>
        </tr>
        <tr>
          <td>{{ __('Miasto') }}</td>
          <td>{{ $user->city }}</td>
        </tr>
        <tr>
          <td>{{ __('Kod pocztowy') }}</td>
          <td>{{ $user->postcode }}</td>
        </tr>
        <tr>
          <td>{{ __('NIP') }}</td>
          <td>{{ $user->nip }}</td>
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
          <td>{{ __('Nazwa') }}</td>
          <td><x-input name="buyer_name"/></td>
        </tr>
        <tr class="form-group">
          <td>{{ __('Adres') }}</td>
          <td><x-input name="buyer_address"/></td>
        </tr>
        <tr class="form-group">
          <td>{{ __('Miasto') }}</td>
          <td><x-input name="buyer_city"/></td>
        </tr>
        <tr class="form-group">
          <td>{{ __('Kod pocztowy') }}</td>
          <td><x-input name="buyer_postcode"/></td>
        </tr>
        <tr class="form-group">
          <td>{{ __('NIP') }}</td>
          <td><x-input name="buyer_nip"/></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>


  <table class="table dataTable dataTable-modal">
    <thead>
    <tr>
      <th>{{ __('Termin płatności') }}</th>
      <th>{{ __('Metoda płatności') }}</th>
    </tr>
    </thead>
    <tbody>
    <tr class="form-group">
      <td><x-input name="payment_due_date"/></td>
      <td><x-input name="payment_method"/></td>
    </tr>
    </tbody>
  </table>

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
      <td><x-input name="positions[1][name]"/></td>
      <td><x-input name="positions[1][quantity]"/></td>
      <td>
        <select class="form-control" name="positions[1][unit]">
          <option>szt</option>
          <option>kg</option>
          <option>godz</option>
        </select>
      </td>
      <td><x-input name="positions[1][price]"/></td>
      <td>
        <select class="form-control" name="positions[1][tax_rate]">
          <option>23%</option>
          <option>8%</option>
          <option>5%</option>
          <option>0%</option>
          <option>zw</option>
        </select>
      </td>
      <td><x-input name="positions[1][discount]"/></td>
      <td class="text-center"><a href="#"><i class="fa fa-plus"></i></a></td>
    </tr>
  </table>
</form>