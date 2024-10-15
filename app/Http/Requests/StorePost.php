<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:70'],
            'category' => ['required'],
            'tradeAction' => ['required_if:category.marketplace,1'],
            'description' => ['required', 'min:20', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'tradeAction.required_if' => 'Trade action field is required.',
        ];
    }
}
