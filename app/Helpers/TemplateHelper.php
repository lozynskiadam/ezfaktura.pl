<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class TemplateHelper
{
    public static function getGeneratorParams()
    {
        $user = Auth::user();
        $params = [
            'payment_due_date' => date('Y-m-d'),
            'payment_method' => 'Przelew',
            'signature' => 'FV/0/0/1',
            'currency' => 'PLN',
            'seller' => [
                'name' => $user->name,
                'address' => $user->address,
                'city' => $user->city,
                'zip_code' => $user->postcode,
                'tax_id' => $user->nip,
            ],
            'buyer' => [
                'name' => __('Nazwa kontrahenta'),
                'address' => __('Adres'),
                'city' => __('Miasto'),
                'zip_code' => '00-000',
                'tax_id' => '0000000000',
            ],
            'positions' => [
                '1' => ['name' => __('Przykładowa usługa'), 'quantity' => 1, 'unit' => 'hour', 'price' => 1000.00, 'tax_rate' => 23, 'discount' => 0]
            ]
        ];
        return $params;
    }
}