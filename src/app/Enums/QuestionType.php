<?php

namespace App\Enums;

enum QuestionType: string
{
    case MULTIPLE_CHOICE = 'multiple_choice';
    case TRUE_OR_FALSE = 'true_or_false';
    case ESSAY = 'essay';
    case SHORT_ANSWER = 'short_answer';
}
