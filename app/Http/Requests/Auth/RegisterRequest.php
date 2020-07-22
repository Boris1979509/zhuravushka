<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name'   => 'string|max:255|nullable',
            'name'        => 'required|string|max:255',
            'middle_name' => 'string|max:255|nullable',
            'email'       => 'required|string|email|max:255|unique:users',
            'password'    => 'required|string|min:8|confirmed',
            'address'     => 'nullable|string',
            'phone'       => 'required|string|unique:users|regex:/^\+7 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}$/',
        ];
    }
}
