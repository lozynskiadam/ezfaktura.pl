<?php

namespace App\Http\Helpers;

class InvoicesHelper
{
    public static function getDataTable()
    {
        $dataTable = new DataTable();

        $dataTable->columns = [
          ['data' => 'IssueDate', 'title' => __('Data wystawienia'), 'width' => 140],
          ['data' => 'InvoiceType', 'title' => __('Typ faktury'), 'width' => 120],
          ['data' => 'Signature', 'title' => __('Sygnatura')],
          ['data' => 'Buyer', 'title' => __('Kontrahent')],
          ['data' => 'Net', 'title' => __('Netto')],
          ['data' => 'Gross', 'title' => __('Brutto')],
        ];
        $dataTable->data = InvoicesHelper::getInvoicesList();
        $dataTable->createdRow = 'App.test';

        return $dataTable;
    }

    private static function getInvoicesList()
    {
        return [
          [
            'IssueDate' => '2020-09-01',
            'InvoiceType' => 'Faktura VAT',
            'Signature' => 'FV/2020/09/0001',
            'Buyer' => 'X-Aps',
            'Net' => '10 000,00 PLN',
            'Gross' => '12 300,00 PLN'
          ],
          [
            'IssueDate' => '2020-10-01',
            'InvoiceType' => 'Faktura VAT',
            'Signature' => 'FV/2020/10/0001',
            'Buyer' => 'X-Aps',
            'Net' => '10 000,00 PLN',
            'Gross' => '12 300,00 PLN'
          ],
          [
            'IssueDate' => '2020-11-01',
            'InvoiceType' => 'Faktura VAT',
            'Signature' => 'FV/2020/11/0001',
            'Buyer' => 'X-Aps',
            'Net' => '10 000,00 PLN',
            'Gross' => '12 300,00 PLN'
          ],
        ];
    }

}