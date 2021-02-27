<div class="row">
  <div class="col-md-8 pr-0">
    <iframe class="preview-pdf" src="{{ route('invoice.preview', ['invoice' => $invoice->id]) }}">
      {{ __('translations.templates.preview.no_pdf_support') }}
    </iframe>
  </div>

  <div class="col-md-4">

    <a href="/invoices/{{ $invoice->id }}/download" class="btn btn-primary btn-sm form-control mb-1">
      <i class="fa fa-download pull-left"></i> {{ __('translations.invoices.show.download') }}
    </a>

    <hr/>

    <button class="btn btn-primary btn-sm form-control mb-1 act-set-paid" @if(!$can_set_paid) disabled @endif>
      @if(!$invoice->is_paid)
        <i class="fa fa-dollar-sign pull-left"></i> {{ __('translations.invoices.show.mark_as_paid') }}
      @else
        <i class="fa fa-check pull-left"></i> {{ __('translations.invoices.show.paid') }}
      @endif
    </button>

    <button class="btn btn-primary btn-sm form-control mb-1 act-set-sent" @if(!$can_set_sent) disabled @endif>
      @if(!$invoice->is_sent)
        <i class="fa fa-envelope pull-left"></i> {{ __('translations.invoices.show.mark_as_sent') }}
      @else
        <i class="fa fa-check pull-left"></i> {{ __('translations.invoices.show.sent') }}
      @endif
    </button>

    <hr/>

    <button class="btn btn-danger btn-sm form-control mb-1 act-delete" @if (!$can_delete) disabled @endif>
      <i class="fa fa-times pull-left"></i> {{ __('translations.invoices.show.delete') }}
    </button>

  </div>

</div>