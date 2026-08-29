<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'disk', 'path', 'thumbnail_path', 'name', 'original_name',
        'mime_type', 'extension', 'size', 'width', 'height', 'alt_text', 'caption',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
