<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nip' => 'required|digits:10',
            'email' => 'unique:users|required|string|email|max:255',
            'password' => 'required|string|confirmed|min:6|max:255',
            'agree' => 'required'
        ];
    }
}
