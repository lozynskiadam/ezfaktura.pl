<?php

namespace App\Classes\DataTables;

class SignaturesTableBuilder extends DataTableBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->setColumns([
            ['data' => 'name', 'title' => __('ID'), 'width' => 100],
            ['data' => 'description', 'title' => __('Opis')],
            ['data' => 'syntax', 'title' => __('Składnia')],
            ['data' => 'invoice_type', 'title' => __('Typy faktur'), 'width' => 150, 'className' => 'text-center', 'render' => 'Renderers.invoice_type'],
        ]);
        $this->setButtons([
            ['text' => '<i class="fa fa-plus"></i> ' . __('Dodaj'), 'action' => 'Pages_Signatures.onAddClick', 'className' => 'btn btn-primary btn-labeled']
        ]);
        $this->setCreatedRowCallback('Pages_Signatures.onRowCreate');
    }
}