<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solution extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 'icon', 'cover_image',
        'display_order', 'featured', 'active', 'seo_title', 'seo_description',
    ];

    protected function casts(): array
    {
        return ['featured' => 'boolean', 'active' => 'boolean'];
    }
}
