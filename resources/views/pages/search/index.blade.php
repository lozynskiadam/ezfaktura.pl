<div class="list-group search-results">

  @foreach($invoices as $invoice)
    <a href="#" class="list-group-item list-group-item-action">
      <div>
        <i class="fas fa-file-pdf fa-2x"></i>
      </div>
      <div>
        <B>{{ $invoice->signature }}</B>
        <span class="pull-right">
            <i class="far fa-file-pdf ml-1"></i> {{ $invoice->invoice_type->initials }}
          </span><br/>
        <small>{{ $invoice->buyer['name'] }}</small>
      </div>
    </a>
  @endforeach

  @foreach($signatures as $signature)
      <a href="#" class="list-group-item list-group-item-action">
        <div>
          <i class="fas fa-tag fa-2x"></i>
        </div>
        <div>
          <B>{{ $signature->name }}</B>
          <span class="pull-right">
            @foreach($signature->invoice_types as $type)
              <i class="far fa-file-pdf ml-1"></i> {{ $type->initials }}
            @endforeach
          </span><br/>
          <small>{{ $signature->description }}</small>
        </div>
      </a>
  @endforeach

</div>

<hr class="widget-separator"/>

<div class="text-center">
  {{ __('translations.search.found') }} <strong>{{ $results }}</strong> {{ trans_choice('translations.search.matching_results', $results) }}
</div>
