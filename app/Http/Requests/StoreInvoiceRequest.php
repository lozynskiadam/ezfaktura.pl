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
            'buyer.name' => 'required|max:255',
            'buyer.address' => 'required|max:255',
            'buyer.city' => 'required|max:255',
            'buyer.postcode' => 'required|max:10',
            'buyer.nip' => 'required|digits:10',
            'invoice.issue_date' => 'required|date_format:Y-m-d',
            'invoice.sale_date' => 'required|date_format:Y-m-d',
            'invoice.payment_due_date' => 'required|date_format:Y-m-d',
            'invoice.payment_method' => 'required|max:255',
            'invoice.positions.*.name' => 'required|max:255',
            'invoice.positions.*.quantity' => ['required', 'numeric', 'gt:0', new MaxDecimalPlaces(4)],
            'invoice.positions.*.unit' => 'required|string|max:255',
            'invoice.positions.*.price' => ['required', 'numeric', 'gt:0', new MaxDecimalPlaces(2)],
            'invoice.positions.*.tax_rate' => 'required|numeric|integer',
            'invoice.positions.*.discount' => 'sometimes|numeric'
        ];
    }

    public function messages()
    {
        return [
            'invoice.positions.*.*.*' => '',
        ];
    }
}
