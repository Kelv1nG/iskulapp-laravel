<?php

namespace App\Enums;

enum LeaveType: int
{
    case SICK_LEAVE = 1;
    case VACATION_LEAVE = 2;
    case ANNUAL_LEAVE = 3;
    case MATERNITY_LEAVE = 4;
}
