<?php

namespace App\Enums;

//TODO:: this needs to be separated for a student record, or the teacher assessment record
enum AssessmentStatus: string
{
    case TO_BE_COMPLETED = 'to_be_completed'; // student + teacher
    case TO_BE_PUBLISHED = 'to_be_published'; // teacher only
    case PUBLISHED = 'published'; // teacher only
    case TO_FINISH_EVALUATION = 'to_finish_evaluation'; // teacher only
    case FINISHED_EVALUATION = 'finished_evaluation'; // student + teacher
}
