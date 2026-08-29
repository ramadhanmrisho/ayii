<?php

namespace App\Models;

use App\Enums\PublicationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'author_id', 'category_id', 'title', 'slug', 'excerpt', 'content',
        'featured_image', 'publication_status', 'published_at', 'seo_title', 'seo_description',
    ];

    protected function casts(): array
    {
        return ['publication_status' => PublicationStatus::class, 'published_at' => 'datetime'];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }
}
