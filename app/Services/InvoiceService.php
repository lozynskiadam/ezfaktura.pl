<?php

namespace App\Services;

use App\Dictionaries\InvoiceTypeDictionary;
use App\Dictionaries\SignatureModeDictionary;
use App\Models\Contractor;
use App\Models\Invoice;
use App\Models\Signature;
use App\Models\SignatureEntry;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use InvoiceGenerator\InvoiceException;

class InvoiceService
{
    private $signatureService;

    public function __construct(SignatureService $signatureService)
    {
        $this->signatureService = $signatureService;
    }

    /**
     * @param User $seller
     * @param Contractor $buyer
     * @param Signature $signature
     * @param array $invoice_data
     * @return Invoice
     * @throws InvoiceException
     * @throws Exception
     */
    public function issue(User $seller, Contractor $buyer, Signature $signature, array $invoice_data): Invoice
    {
        $signature_entry = $this->signatureService->addEntry($signature, Carbon::createFromFormat('Y-m-d', $invoice_data['issue_date']));

        $generator = new \InvoiceGenerator\Invoice([
            'signature' => $signature_entry->value,
            'issue_date' => $invoice_data['issue_date'],
            'sale_date' => $invoice_data['sale_date'],
            'payment_due_date' => $invoice_data['payment_due_date'],
            'payment_method' => $invoice_data['payment_method'],
            'positions' => $invoice_data['positions'],
            'seller' => [
                'name' => $seller->name,
                'address' => $seller->address,
                'city' => $seller->city,
                'zip_code' => $seller->postcode,
                'tax_id' => $seller->nip,
            ],
            'buyer' => [
                'name' => $buyer->name,
                'address' => $buyer->address,
                'city' => $buyer->city,
                'zip_code' => $buyer->postcode,
                'tax_id' => $buyer->nip,
            ],
        ]);
        $output = '/generated/' . time() . '.pdf';
        $generator->pdf(['output' => base_path($output)]);

        $invoice = new Invoice();
        $invoice->fill((array)$generator);
        $invoice->user_id = $seller->id;
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
        }

        return false;
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