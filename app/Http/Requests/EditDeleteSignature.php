<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditDeleteSignature extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->signatures()->find($this->route('signature'))->first()) {
            return true;
        }

        return false;
    }

    public function rules()
    {
        return [];
    }
}
