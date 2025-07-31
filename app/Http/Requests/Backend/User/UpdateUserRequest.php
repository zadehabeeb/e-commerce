<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
        $userId = $this->route('user'); // Assuming the route parameter is named 'user'
        return [
            'name'         => 'required|string|max:255',
            'email'        => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'password'     => 'nullable|string|min:8',
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
