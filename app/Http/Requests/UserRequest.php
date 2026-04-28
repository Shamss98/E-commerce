<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

use function Symfony\Component\String\u;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


public function rules(): array
{
    return [
        'name' => 'required|string|max:255',

        'email' => 'required|email|unique:users,email,' . $this->route('user')->id,

        'password' => 'nullable|min:6',

        'role' => 'required|in:admin,user',
    ];
}
}
