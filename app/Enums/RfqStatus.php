<?php

namespace App\Enums;

enum RfqStatus: string
{
    case New = 'new';
    case UnderReview = 'under_review';
    case QuotationPrepared = 'quotation_prepared';
    case Sent = 'sent';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Completed = 'completed';

    public function label(): string
    {
        return str($this->value)->replace('_', ' ')->title()->toString();
    }
}
