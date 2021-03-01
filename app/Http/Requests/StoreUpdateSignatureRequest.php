<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUpdateSignatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'signatures.store') {
            return true;
        }

        if ($this->route()->getName() == 'signatures.update') {
            if (Auth::user()->signatures()->find($this->route('signature'))->first()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:35|regex:/^[a-z0-9-]*$/',
            'syntax' => 'required|max:50|regex:/{counter}/',
            'description' => 'required|max:255',
            'mode' => 'required|in:monthly,yearly',
            'invoice_types' => 'required|exists:invoice_types,id'
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => __('validation.signature.name.regex'),
            'syntax.regex' => __('validation.signature.syntax.regex'),
        ];
    }
}
