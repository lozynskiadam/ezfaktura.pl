<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUpdateSignature extends FormRequest
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
          'name' => 'required|regex:/^[a-z0-9-]*$/',
          'syntax' => 'required|regex:/{counter}/',
          'description' => 'required',
          'mode' => 'required|in:monthly,yearly',
          'invoice_types' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'name.regex' => 'ID must contain only lower case letters, numbers and dashes',
          'syntax.regex' => 'Syntax must contain {counter}',
        ];
    }
}
