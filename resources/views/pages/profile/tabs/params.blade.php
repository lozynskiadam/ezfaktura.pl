<div class="row">

  <div class="col-md-6">
    <div class="parameters-header">{{ __('Fakturowanie') }}</div>
    <x-param name="DefaultCurrency" :label="__('Domyślna waluta')" :options="$CurrencyList"/>
    <x-param name="AskForCurrency" :label="__('Pytaj o walutę')" :options="$BooleanList"/>
    <x-param name="DefaultPaymentMethod" :label="__('Domyślna metoda płatności')" :options="$PaymentMethodList"/>
    <x-param name="AskForPaymentMethod" :label="__('Pytaj o metodę płatności')" :options="$BooleanList"/>
    <x-param name="DefaultDiscountType" :label="__('Domyślny typ rabatów')" :options="$DiscountTypeList"/>
    <x-param name="AskForDiscountType" :label="__('Pytaj o typ rabatu')" :options="$BooleanList"/>
    <x-param name="AllowInvoicingOnlyVatPayers" :label="__('Zezwalaj na wystawienie faktury tylko kontrahentom, którzy są aktywnymi płatnikami VAT')" :options="$BooleanList"/>
    <x-param name="MarkRoundedValues" :label="__('Dodawaj znacznik \'~\' przy zaokrąglonych wartościach pozycji faktury')" :options="$BooleanList"/>
  </div>

  <div class="col-md-6">
    <div class="parameters-header">{{ __('Powiadomienia') }}</div>
    <x-param name="SuccessApiOperation" :label="__('Udana operacja wystawienia faktury za pomocą twojego klucza API')" :options="$BooleanList"/>
    <x-param name="FailedApiOperation" :label="__('Nieudana operacja wystawienia faktury za pomocą twojego klucza API')" :options="$BooleanList"/>
  </div>

</div>
