<?php

namespace App\Enums;

enum AssessmentStatus: string
{
    case TO_BE_COMPLETED = 'to_be_completed';
    case TO_BE_PUBLISHED = 'to_be_published';
    case PUBLISHED = 'published';
    case TO_FINISH_EVALUATION = 'to_finish_evaluation';
    case FINISHED_EVALUATION = 'finished_evaluation';
}
