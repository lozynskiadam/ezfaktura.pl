<?php

namespace App\Classes\DataTables;

class SignaturesTableBuilder extends DataTableBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setColumns([
            [
                'data' => 'name',
                'title' => __('translations.signatures.list.column.name'),
                'width' => 100
            ],
            [
                'data' => 'description',
                'title' => __('translations.signatures.list.column.description')
            ],
            [
                'data' => 'syntax',
                'title' => __('translations.signatures.list.column.syntax'),
                'render' => 'Renderers.signature_syntax',
            ],
            [
                'data' => 'invoice_type',
                'title' => __('translations.signatures.list.column.invoice_types'),
                'className' => 'text-center',
                'render' => 'Renderers.invoice_type',
                'width' => 125
            ],
        ]);
        $this->setButtons([
            [
                'text' => '<i class="fa fa-plus"></i> ' . __('translations.signatures.list.button.add'),
                'action' => 'Pages_Signatures.onAddClick',
                'className' => 'btn btn-primary btn-labeled'
            ]
        ]);
        $this->setCreatedRowCallback('Pages_Signatures.onRowCreate');
    }
}