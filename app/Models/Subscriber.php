<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'active', 'subscribed_at'];

    protected function casts(): array
    {
        return ['active' => 'boolean', 'subscribed_at' => 'datetime'];
    }
}
