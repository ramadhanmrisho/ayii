<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('settings.manage');
    }

    public function rules(): array
    {
        return [
            'general.company_name' => ['required', 'string', 'max:120'],
            'general.tagline' => ['nullable', 'string', 'max:160'],
            'general.industry' => ['nullable', 'string', 'max:180'],
            'contact.phone' => ['nullable', 'string', 'max:60'],
            'contact.whatsapp' => ['nullable', 'string', 'max:60'],
            'contact.email' => ['nullable', 'email', 'max:160'],
            'contact.address' => ['nullable', 'string', 'max:1000'],
            'seo.default_title' => ['nullable', 'string', 'max:180'],
            'seo.default_meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
