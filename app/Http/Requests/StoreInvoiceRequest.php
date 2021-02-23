<?php

namespace App\Http\Requests;

use App\Models\Signature;
use App\Rules\BelongsToUser;
use App\Rules\MaxDecimalPlaces;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'signature_id' => ['required', new BelongsToUser(Signature::class)],
            'payment_due_date' => 'required|date_format:Y-m-d',
            'payment_method' => 'required|max:255',
            'buyer_name' => 'required|max:255',
            'buyer_address' => 'required|max:255',
            'buyer_city' => 'required|max:255',
            'buyer_postcode' => 'required|max:10',
            'buyer_nip' => 'required|digits:10',
            'positions.*.name' => 'required|max:255',
            'positions.*.quantity' => ['required', 'numeric', 'gt:0', new MaxDecimalPlaces(4)],
            'positions.*.unit' => 'required|string|max:255',
            'positions.*.price' => ['required', 'numeric', 'gt:0', new MaxDecimalPlaces(2)],
            'positions.*.tax_rate' => 'required|numeric|integer',
            'positions.*.discount' => 'sometimes|numeric'
        ];
    }

    public function messages()
    {
        return [
            'positions.*.*.*' => '',
        ];
    }
}
