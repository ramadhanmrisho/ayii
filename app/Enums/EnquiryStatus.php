<?php

namespace App\Enums;

enum EnquiryStatus: string
{
    case New = 'new';
    case Read = 'read';
    case Responded = 'responded';
    case Closed = 'closed';
}
