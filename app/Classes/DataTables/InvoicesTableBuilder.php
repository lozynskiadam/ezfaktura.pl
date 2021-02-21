<?php

namespace App\Classes\DataTables;

class InvoicesTableBuilder extends DataTableBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setColumns([
            ['data' => 'invoice_type', 'title' => __('Typ'), 'width' => 60, 'className' => 'text-center', 'render' => 'Renderers.invoice_type'],
            ['data' => 'issue_date', 'title' => __('Data wystawienia'), 'width' => 130, 'className' => 'text-center'],
            ['data' => 'signature', 'title' => __('Sygnatura')],
            ['data' => 'buyer', 'title' => __('Kontrahent'), 'render' => 'Renderers.contractor'],
            ['data' => 'buyer', 'title' => __('NIP'), 'render' => 'Renderers.tax_id'],
            ['data' => 'net_total', 'title' => __('Netto'), 'render' => 'Renderers.currency', 'className' => 'text-right', 'type' => 'currency'],
            ['data' => 'gross_total', 'title' => __('Brutto'), 'render' => 'Renderers.currency', 'className' => 'text-right', 'type' => 'currency'],
        ]);
        $this->setButtons([
            ['text' => '<i class="fa fa-plus"></i> ' . __('Wystaw'), 'action' => 'Pages_Invoices.onAddClick', 'className' => 'btn btn-primary btn-labeled']
        ]);
        $this->setCreatedRowCallback('Pages_Invoices.onRowCreate');
    }

}