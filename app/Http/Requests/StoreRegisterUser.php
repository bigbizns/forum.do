<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'max:15', 'min:3', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required','min:8','confirmed'],
        ];
    }
}
