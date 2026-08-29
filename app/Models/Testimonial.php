<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_name', 'organization', 'position', 'photo', 'organization_logo',
        'testimonial', 'rating', 'approved', 'featured', 'active', 'sort_order',
    ];

    protected function casts(): array
    {
        return ['approved' => 'boolean', 'featured' => 'boolean', 'active' => 'boolean'];
    }
}
