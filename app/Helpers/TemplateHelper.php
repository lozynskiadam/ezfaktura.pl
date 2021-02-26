<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TemplateHelper
{
    public static function getGeneratorParams()
    {
        $user = Auth::user();
        return [
            'payment_due_date' => date('Y-m-d'),
            'payment_method' => __('translations.templates.preview.payment_method'),
            'signature' => 'FV/' .Carbon::now()->format('Y/m'). '/00001',
            'currency' => 'PLN',
            'seller' => [
                'name' => $user->name,
                'address' => $user->address,
                'city' => $user->city,
                'zip_code' => $user->postcode,
                'tax_id' => $user->nip,
            ],
            'buyer' => [
                'name' => __('translations.templates.preview.buyer.name'),
                'address' => __('translations.templates.preview.buyer.address'),
                'city' => __('translations.templates.preview.buyer.city'),
                'zip_code' => __('translations.templates.preview.buyer.zip_code'),
                'tax_id' => __('translations.templates.preview.buyer.tax_id'),
            ],
            'positions' => [
                '1' => [
                    'name' => __('translations.templates.preview.position.name'),
                    'quantity' => 40,
                    'unit' => __('translations.templates.preview.position.unit'),
                    'price' => 100.00,
                    'tax_rate' => 23,
                    'discount' => 0
                ]
            ]
        ];
    }
}