<form>
  <h3>{{ __('Informacje podstawowe') }}</h3>
  <x-input name="payment_due_date" :label="__('Termin płatności')"/>
  <x-input name="payment_method" :label="__('Metoda płatności')"/>

  <h3>{{ __('Kontrahent') }}</h3>
  <x-input name="buyer_name" :label="__('Nazwa')"/>
  <x-input name="buyer_address" :label="__('Adres')"/>
  <x-input name="buyer_city" :label="__('Miasto')"/>
  <x-input name="buyer_postcode" :label="__('Kod pocztowy')"/>
  <x-input name="buyer_nip" :label="__('NIP')"/>

  <h3>{{ __('Pozycje faktury') }}</h3>
  <x-input name="positions[1][name]" :label="__('Nazwa')"/>
  <x-input name="positions[1][quantity]" :label="__('Ilość')"/>
  <x-input name="positions[1][unit]" :label="__('Jednostka')"/>
  <x-input name="positions[1][price]" :label="__('Cena jednostkowa')"/>
  <x-input name="positions[1][tax_rate]" :label="__('Stawka VAT')"/>
  <x-input name="positions[1][discount]" :label="__('Rabat')"/>
</form>