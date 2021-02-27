<?php

namespace App\Services;

use App\Dictionaries\SignatureModeDictionary;
use App\Models\Signature;
use App\Models\SignatureEntry;
use Carbon\Carbon;

class SignatureService
{
    public function addEntry($signature_id, $date = null)
    {
        $date = $date ? Carbon::createFromFormat('Y-m-d', $date) : Carbon::now();

        $signature = Signature::findOrFail($signature_id);

        switch ($signature->mode) {
            case SignatureModeDictionary::YEARLY:
                $counter = SignatureEntry::where('signature_id', $signature->id)
                        ->whereYear('date', $date->format('Y'))
                        ->count() + 1;
                break;
            case SignatureModeDictionary::MONTHLY:
                $counter = SignatureEntry::where('signature_id', $signature->id)
                        ->whereYear('date', $date->format('Y'))
                        ->whereMonth('date', $date->format('m'))
                        ->count() + 1;
                break;
            default:
                throw new \Exception('Unexpected signature mode');
                break;
        }

        $signature_entry = new SignatureEntry;
        $signature_entry->signature_id = $signature->id;
        $signature_entry->date = $date->format('Y-m-d');
        $signature_entry->counter = $counter;
        $signature_entry->value = strtr($signature->syntax, [
            '{counter}' => str_pad($counter, 5, '0', STR_PAD_LEFT),
            '{year}' => $date->format('Y'),
            '{month}' => $date->format('m'),
        ]);
        $signature_entry->save();

        return $signature_entry;
    }
}