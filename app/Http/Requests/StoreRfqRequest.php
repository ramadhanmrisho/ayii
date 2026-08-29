<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRfqRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'organization' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:60'],
            'location' => ['nullable', 'string', 'max:180'],
            'required_delivery_date' => ['nullable', 'date', 'after_or_equal:today'],
            'message' => ['nullable', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,avif', 'max:5120'],
            'items' => ['nullable', 'array'],
            'items.*.product_id' => ['nullable', 'exists:products,id'],
            'items.*.product_name' => ['required_with:items', 'string', 'max:180'],
            'items.*.quantity' => ['required_with:items', 'integer', 'min:1', 'max:9999'],
            'items.*.notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
