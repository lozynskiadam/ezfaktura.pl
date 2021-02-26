<?php

namespace App\Classes\DataTables;

class InvoicesTableBuilder extends DataTableBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setColumns([
            [
                'data' => 'invoice_type',
                'title' => __('translations.invoices.list.column.invoice_type'),
                'className' => 'text-center',
                'render' => 'Renderers.invoice_type',
                'width' => 60
            ],
            [
                'data' => 'issue_date',
                'title' => __('translations.invoices.list.column.issue_date'),
                'className' => 'text-center',
                'width' => 130,
            ],
            [
                'data' => 'signature',
                'title' => __('translations.invoices.list.column.signature')
            ],
            [
                'data' => 'buyer',
                'title' => __('translations.invoices.list.column.buyer_name'),
                'render' => 'Renderers.contractor'
            ],
            [
                'data' => 'buyer',
                'title' => __('translations.invoices.list.column.buyer_tax_id'),
                'render' => 'Renderers.tax_id'
            ],
            [
                'data' => 'net_total',
                'title' => __('translations.invoices.list.column.net_total'),
                'render' => 'Renderers.currency',
                'className' => 'text-right',
                'type' => 'currency'
            ],
            [
                'data' => 'gross_total',
                'title' => __('translations.invoices.list.column.gross_total'),
                'render' => 'Renderers.currency',
                'className' => 'text-right',
                'type' => 'currency'
            ],
            [
                'data' => 'is_paid',
                'className' => 'text-center',
                'render' => 'Renderers.is_paid',
                'width' => 25
            ],
            [
                'data' => 'is_sent',
                'className' => 'text-center',
                'render' => 'Renderers.is_sent',
                'width' => 25
            ],
        ]);
        $this->setButtons([
            [
                'text' => '<i class="fa fa-plus"></i> ' . __('translations.invoices.list.button.issue'),
                'action' => 'Pages_Invoices.onAddClick',
                'className' => 'btn btn-primary btn-labeled'
            ]
        ]);
        $this->setCreatedRowCallback('Pages_Invoices.onRowCreate');
    }

}