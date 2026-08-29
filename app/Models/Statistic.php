<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['value', 'suffix', 'label', 'description', 'icon', 'sort_order', 'active'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }
}
