<?php

namespace App\Enums;

enum AssessmentType: string
{
    case ASSIGNMENT = 'assignment';
    case QUIZ = 'quiz';
    case EXAM = 'exam';
}
