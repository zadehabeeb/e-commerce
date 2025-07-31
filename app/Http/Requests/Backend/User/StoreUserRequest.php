<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email',
            'password'     => 'required|string|min:8',
            'phone'        => 'nullable|string|max:20',
            'address'      => 'nullable|string',
            'city'         => 'nullable|string|max:100',
            'postal_code'  => 'nullable|string|max:20',
            'country'      => 'nullable|string|max:100',
            'avatar'       => 'nullable|string',
            'is_active'    => 'nullable|boolean',
        ];
    }
}
