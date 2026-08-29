<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title', 'description', 'desktop_image', 'mobile_image', 'cta_text',
        'cta_url', 'start_at', 'end_at', 'position', 'active',
    ];

    protected function casts(): array
    {
        return ['active' => 'boolean', 'start_at' => 'datetime', 'end_at' => 'datetime'];
    }

    public function scopeCurrentlyVisible(Builder $query): Builder
    {
        return $query->where('active', true)
            ->where(fn (Builder $q) => $q->whereNull('start_at')->orWhere('start_at', '<=', now()))
            ->where(fn (Builder $q) => $q->whereNull('end_at')->orWhere('end_at', '>=', now()));
    }
}
