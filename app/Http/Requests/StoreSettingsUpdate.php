<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingsUpdate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:20', 'min:3', 'unique:users,username'],
            'email' => ['required', 'email', 'max:50', 'min:3', 'unique:users,email'],
            'description' => ['nullable', 'string', 'max:50'],
        ];
    }
}
