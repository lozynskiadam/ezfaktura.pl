<?php

namespace App\Classes\DataTables;

use Illuminate\Support\Facades\Auth;

class SignaturesTableBuilder extends DataTableBuilder
{
    public function setColumns(): array
    {
        return [
            ['data' => 'name', 'title' => __('ID'), 'width' => 100],
            ['data' => 'description', 'title' => __('Opis')],
            ['data' => 'syntax', 'title' => __('Składnia')],
            ['data' => 'invoice_type', 'title' => __('Typy faktur'), 'width' => 150, 'className' => 'text-center', 'render' => 'Renderers.invoice_type'],
        ];
    }

    public function setButtons(): array
    {
        return [
            [
                'text' => '<i class="fa fa-plus"></i> ' . __('Dodaj'),
                'action' => 'Pages_Signatures.onAddClick',
                'className' => 'btn btn-primary btn-labeled'
            ]
        ];
    }

    public function setCreatedRowCallback(): ?string
    {
        return 'Pages_Signatures.onRowCreate';
    }

    public function setData(): array
    {
        return Auth::user()->signatures()->with('invoice_types')->get()->toArray();
    }
}