<?php

namespace App\Services;

use App\Dictionaries\InvoiceTypeDictionary;
use App\Models\Contractor;
use App\Models\Invoice;
use App\Models\User;
use InvoiceGenerator\InvoiceException;

class InvoiceService
{
    /**
     * @param $user_id
     * @param $contractor_id
     * @param $invoice_data
     * @return Invoice
     * @throws InvoiceException
     */
    public function createInvoice($user_id, $contractor_id, $invoice_data) : Invoice
    {
        $user = User::findOrFail($user_id);
        $contractor = Contractor::findOrFail($contractor_id);

        $generator = new \InvoiceGenerator\Invoice([
            'issue_date' => $invoice_data['issue_date'],
            'sale_date' => $invoice_data['sale_date'],
            'payment_due_date' => $invoice_data['payment_due_date'],
            'payment_method' => $invoice_data['payment_method'],
            'positions' => $invoice_data['positions'],
            'seller' => [
                'name' => $user->name,
                'address' => $user->address,
                'city' => $user->city,
                'zip_code' => $user->postcode,
                'tax_id' => $user->nip,
            ],
            'buyer' => [
                'name' => $contractor->name,
                'address' => $contractor->address,
                'city' => $contractor->city,
                'zip_code' => $contractor->postcode,
                'tax_id' => $contractor->nip,
            ],
        ]);
        $output = '/generated/' . time() . '.pdf';
        $generator->pdf(['output' => base_path($output)]);

        $invoice = new Invoice();
        $invoice->fill((array)$generator);
        $invoice->user_id = $user->id;
        $invoice->signature_id = $invoice_data['signature_id'];
        $invoice->invoice_type_id = InvoiceTypeDictionary::BASIC;
        $invoice->file_path = $output;
        $invoice->save();
        $invoice->load(['invoice_type']);

        return $invoice;
    }
}