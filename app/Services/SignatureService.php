<?php

namespace App\Services;

use App\Dictionaries\SignatureModeDictionary;
use App\Models\Signature;
use App\Models\SignatureEntry;
use Carbon\Carbon;

class SignatureService
{
    public function addEntry(Signature $signature, Carbon $date = null): SignatureEntry
    {
        $date = $date ? $date : Carbon::now();

        $signature_entry = new SignatureEntry;
        $signature_entry->signature_id = $signature->id;
        $signature_entry->date = $date->format('Y-m-d');
        $signature_entry->counter = $this->getNextSignatureCounter($signature, $date);
        $signature_entry->value = strtr($signature->syntax, [
            '{counter}' => str_pad($signature_entry->counter, $signature->padding, '0', STR_PAD_LEFT),
            '{year}' => $date->format('Y'),
            '{month}' => $date->format('m'),
        ]);
        $signature_entry->save();

        return $signature_entry;
    }

    public function getNextSignatureCounter(Signature $signature, Carbon $date = null): int
    {
        $date = $date ? $date : Carbon::now();

        switch ($signature->mode) {
            case SignatureModeDictionary::YEARLY:
                return $signature->signature_entries()
                        ->whereYear('date', $date->format('Y'))
                        ->count() + 1;
            case SignatureModeDictionary::MONTHLY:
                return $signature->signature_entries()
                        ->whereYear('date', $date->format('Y'))
                        ->whereMonth('date', $date->format('m'))
                        ->count() + 1;
            default:
                throw new \Exception('Unexpected signature mode');
                break;
        }
    }
}