<?php

namespace App\Enums;

//TODO:: this needs to be separated for a student record, or the teacher assessment record
enum AttendanceStatus: string
{
    case PRESENT = 'present';
    case LATE = 'late';
    case ABSENT = 'absent';
    case AUTHORIZED_ABSENT = 'to_finish_evaluation';
}
