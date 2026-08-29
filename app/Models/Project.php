<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'client', 'industry', 'location', 'year', 'description',
        'products_supplied', 'services_provided', 'status', 'cover_image', 'featured',
        'seo_title', 'seo_description',
    ];

    protected function casts(): array
    {
        return ['featured' => 'boolean'];
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }
}
