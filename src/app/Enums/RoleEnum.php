<?php

namespace App\Enums;

enum RoleEnum: string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case PARENT = 'parent';
    case ADMIN = 'admin';
}
