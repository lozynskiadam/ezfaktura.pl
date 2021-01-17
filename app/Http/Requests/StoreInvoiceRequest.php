<?php

namespace App\Http\Requests;

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
            'payment_due_date' => 'required|date_format:Y-m-d',
            'payment_method' => 'required',
            'buyer_name' => 'required',
            'buyer_address' => 'required',
            'buyer_city' => 'required',
            'buyer_postcode' => 'required',
            'buyer_nip' => 'required',
        ];
    }
}
