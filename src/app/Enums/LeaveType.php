<?php

namespace App\Enums;

enum LeaveType: string
{
    case SICK_LEAVE = 'Sick_Leave';
    case VACATION_LEAVE = 'Vacation_Leave';
    case ANNUAL_LEAVE = 'Annual_Leave';
    case MATERNITY_LEAVE = 'Maternity_Leave';
}
