<?php

namespace App\Services;

use App\Dictionaries\InvoiceTypeDictionary;
use App\Dictionaries\SignatureModeDictionary;
use App\Models\Contractor;
use App\Models\Invoice;
use App\Models\SignatureEntry;
use App\Models\User;
use Carbon\Carbon;
use InvoiceGenerator\InvoiceException;

class InvoiceService
{
    /**
     * @param $user_id
     * @param $contractor_id
     * @param $signature_entry_id
     * @param $invoice_data
     * @return Invoice
     * @throws InvoiceException
     */
    public function createInvoice($user_id, $contractor_id, $signature_entry_id, $invoice_data): Invoice
    {
        $user = User::findOrFail($user_id);
        $contractor = Contractor::findOrFail($contractor_id);
        $signature_entry = SignatureEntry::findOrFail($signature_entry_id);

        $generator = new \InvoiceGenerator\Invoice([
            'signature' => $signature_entry->value,
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
        $invoice->signature_entry_id = $signature_entry->id;
        $invoice->invoice_type_id = InvoiceTypeDictionary::BASIC;
        $invoice->file_path = $output;
        $invoice->save();
        $invoice->load(['invoice_type']);

        return $invoice;
    }

    public function isLastInSignature(Invoice $invoice): bool
    {
        if(!$invoice->signature_entry()->exists()) {
            return false;
        }

        $signature_entry = $invoice->signature_entry()->first();
        $signature = $signature_entry->signature()->first();
        $date = Carbon::createFromFormat('Y-m-d', $signature_entry->date);

        switch ($signature->mode) {
            case SignatureModeDictionary::YEARLY:
                return SignatureEntry
                        ::where('signature_id', $signature_entry->signature_id)
                        ->where('counter', '>', $signature_entry->counter)
                        ->whereYear('date', $date->format('Y'))
                        ->count() === 0;
            case SignatureModeDictionary::MONTHLY:
                return SignatureEntry
                        ::where('signature_id', $signature_entry->signature_id)
                        ->where('counter', '>', $signature_entry->counter)
                        ->whereYear('date', $date->format('Y'))
                        ->whereMonth('date', $date->format('m'))
                        ->count() === 0;
            default:
                return false;
        }
    }

    public function canSetPaid(Invoice $invoice): bool
    {
        if($invoice->is_paid) {
            return false;
        }
        return true;
    }

    public function canSetSent(Invoice $invoice): bool
    {
        if($invoice->is_sent) {
            return false;
        }
        return true;
    }

    public function canDelete(Invoice $invoice): bool
    {
        if($invoice->signature_entry()->exists() && !$this->isLastInSignature($invoice)) {
            return false;
        }
        return true;
    }
}