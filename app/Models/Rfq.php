<?php

namespace App\Models;

use App\Enums\RfqStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rfq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reference', 'name', 'organization', 'email', 'phone', 'location',
        'required_delivery_date', 'message', 'attachment', 'quotation_file',
        'status', 'assigned_to', 'internal_notes',
    ];

    protected function casts(): array
    {
        return ['required_delivery_date' => 'date', 'status' => RfqStatus::class];
    }

    public function items(): HasMany
    {
        return $this->hasMany(RfqItem::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
