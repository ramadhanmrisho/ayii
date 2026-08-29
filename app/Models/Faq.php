<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'category', 'sort_order', 'active'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }
}
