<?php

namespace App\Enums;

enum LeaveStatus: int
{
    case Pending = 1;
    case Approved = 2;
    case Rejected = 3;
}
