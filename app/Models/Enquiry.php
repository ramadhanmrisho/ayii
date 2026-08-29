<?php

namespace App\Models;

use App\Enums\EnquiryStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    protected $fillable = ['full_name', 'organization', 'phone', 'email', 'subject', 'message', 'status'];

    protected function casts(): array
    {
        return ['status' => EnquiryStatus::class];
    }
}
