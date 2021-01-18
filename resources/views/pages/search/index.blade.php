<div class="list-group search-results">

  @foreach($invoices as $invoice)
    <a href="#" class="list-group-item list-group-item-action">
      <i class="fas fa-file-pdf fa-2x"></i> {{ $invoice->name }}
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
  {{ __('znaleziono') }} <strong>{{ count($invoices) + count($signatures) }}</strong> {{ __('pasujących wyników') }}
</div>