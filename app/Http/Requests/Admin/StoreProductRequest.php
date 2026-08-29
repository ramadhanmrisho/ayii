<?php

namespace App\Http\Requests\Admin;

use App\Enums\PublicationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can($this->route('product') ? 'products.update' : 'products.create');
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200', Rule::unique('products', 'slug')->ignore($product)],
            'sku' => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($product)],
            'model' => ['nullable', 'string', 'max:120'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'key_features' => ['nullable', 'string'],
            'warranty' => ['nullable', 'string', 'max:160'],
            'availability' => ['required', 'string', 'max:80'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'show_price' => ['nullable', 'boolean'],
            'quote_only' => ['nullable', 'boolean'],
            'featured' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
            'publication_status' => ['required', Rule::enum(PublicationStatus::class)],
            'seo_title' => ['nullable', 'string', 'max:180'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:5120'],
            'specifications' => ['nullable', 'array'],
            'specifications.*.name' => ['nullable', 'string', 'max:120'],
            'specifications.*.value' => ['nullable', 'string', 'max:500'],
        ];
    }
}
