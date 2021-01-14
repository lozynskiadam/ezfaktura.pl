<?php

namespace App\Http\Controllers;

class TemplateController extends Controller
{
    public function list()
    {
        $columns = [
            'position_number' => __('Lp.'),
            'name' => __('Nazwa'),
            'unit' => __('Jednostka miary'),
            'quantity' => __('Ilość'),
            'tax_rate' => __('Stawka VAT'),
            'tax_amount' => __('Kwota VAT'),
            'net_price' => __('Cena netto'),
            'net_amount' => __('Wartość netto'),
            'gross_price' => __('Cena brutto'),
            'gross_amount' => __('Wartość brutto'),
        ];

        return view('pages.templates.index', [
            'columns' => $columns
        ]);
    }
}
