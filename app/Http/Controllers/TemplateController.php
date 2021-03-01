<?php

namespace App\Http\Controllers;

use App\Helpers\TemplateHelper;
use InvoiceGenerator\Invoice AS InvoiceGenerator;
use InvoiceGenerator\InvoiceException;

class TemplateController extends Controller
{
    public function index()
    {
        $columns = [
            'position_number' => __('translations.templates.columns.position_number'),
            'name' => __('translations.templates.columns.name'),
            'unit' => __('translations.templates.columns.unit'),
            'quantity' => __('translations.templates.columns.quantity'),
            'discount' => __('translations.templates.columns.discount'),
            'tax_rate' => __('translations.templates.columns.tax_rate'),
            'tax_amount' => __('translations.templates.columns.tax_amount'),
            'net_price' => __('translations.templates.columns.net_price'),
            'net_amount' => __('translations.templates.columns.net_amount'),
            'gross_price' => __('translations.templates.columns.gross_price'),
            'gross_amount' => __('translations.templates.columns.gross_amount'),
        ];

        return view('pages.templates.index', [
            'columns' => $columns
        ]);
    }

    public function preview()
    {
        try {
            $generator = new InvoiceGenerator(TemplateHelper::getGeneratorParams());
            $generator->pdf();
        } catch (InvoiceException $e) {}
    }
}
