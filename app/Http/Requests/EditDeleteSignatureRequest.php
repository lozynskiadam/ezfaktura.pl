<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditDeleteSignatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->signatures()->find($this->signature->id)->exists()) {
            return true;
        }
        return false;
    }

    public function rules()
    {
        return [];
    }
}
