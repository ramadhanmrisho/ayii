<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id', 'category_id', 'name', 'slug', 'sku', 'model', 'short_description',
        'description', 'key_features', 'warranty', 'availability', 'price', 'show_price',
        'quote_only', 'featured', 'is_new', 'active', 'publication_status', 'seo_title', 'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'key_features' => 'array',
            'price' => 'decimal:2',
            'show_price' => 'boolean',
            'quote_only' => 'boolean',
            'featured' => 'boolean',
            'is_new' => 'boolean',
            'active' => 'boolean',
            'publication_status' => PublicationStatus::class,
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderByDesc('is_primary')->orderBy('sort_order');
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true)->latestOfMany();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('active', true)->where('publication_status', PublicationStatus::Published->value);
    }
}
