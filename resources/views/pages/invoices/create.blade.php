<form>
  <x-input name="payment_due_date" :label="__('Termin płatności')"/>
  <x-input name="payment_method" :label="__('Metoda płatności')"/>

  <x-input name="buyer_name" :label="__('Nazwa')"/>
  <x-input name="buyer_address" :label="__('Adres')"/>
  <x-input name="buyer_city" :label="__('Miasto')"/>
  <x-input name="buyer_postcode" :label="__('Kod pocztowy')"/>
  <x-input name="buyer_nip" :label="__('NIP')"/>

  <table class="table dataTable">
    <thead>
    <tr>
      <th>{{ __('Nazwa') }}</th>
      <th>{{ __('Ilość') }}</th>
      <th>{{ __('Jednostka') }}</th>
      <th>{{ __('Cena jednostkowa') }}</th>
      <th>{{ __('Stawka VAT') }}</th>
      <th>{{ __('Rabat') }}</th>
    </tr>
    </thead>
    <tr>
      <td><input type="text" name="positions[1][name]"/></td>
      <td><input type="text" name="positions[1][quantity]"/></td>
      <td><input type="text" name="positions[1][unit]"/></td>
      <td><input type="text" name="positions[1][price]"/></td>
      <td><input type="text" name="positions[1][tax_rate]"/></td>
      <td><input type="text" name="positions[1][discount]"/></td>
    </tr>
  </table>
</form>