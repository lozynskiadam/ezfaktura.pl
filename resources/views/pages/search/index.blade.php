<div class="list-group">

  @foreach($invoices as $invoice)
    <a href="#" class="list-group-item list-group-item-action">
      <i class="fas fa-file-pdf fa-2x"></i> {{ $invoice->name }}
    </a>
  @endforeach

  @foreach($signatures as $signature)
    <a href="#" class="list-group-item list-group-item-action">
      <i class="fas fa-tag fa-2x"></i> {{ $signature->name }}
    </a>
  @endforeach

</div>