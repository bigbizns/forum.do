<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreSettingsUpdate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();

        return [
            'username' => ['required', 'string', 'max:20', 'min:3', Rule::unique('users', 'username')->ignore($user?->id)],
            'email' => ['required', 'email', 'max:50', 'min:3', Rule::unique('users', 'email')->ignore($user?->id)],
            'description' => ['nullable', 'string', 'max:50'],
        ];
    }
}
