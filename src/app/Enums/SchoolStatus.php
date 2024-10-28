<?php

namespace App\Enums;

enum SchoolStatus: string
{
    case INQUIRED = 'inquired';
    case DEMO = 'demo';
    case TRIAL = 'trial';
    case CURRENT = 'current';
    case EXPIRED = 'expired';
    case CLOSED = 'closed';
}
