<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnquiryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'organization' => ['nullable', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:60'],
            'email' => ['required', 'email', 'max:160'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
