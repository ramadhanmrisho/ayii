<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('brands.manage');
    }

    public function rules(): array
    {
        $brand = $this->route('brand');

        return [
            'name' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', Rule::unique('brands', 'slug')->ignore($brand)],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'description' => ['nullable', 'string'],
            'website' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
        ];
    }
}
