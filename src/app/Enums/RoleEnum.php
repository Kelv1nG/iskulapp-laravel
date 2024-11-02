<?php

namespace App\Enums;

use function Symfony\Component\String\s;

enum RoleEnum: string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case PARENT = 'parent';
    case ADMIN = 'admin';

    public static function rolesForApi(): array
    {
        return array(
          self::STUDENT,
          self::TEACHER,
          self::PARENT,
        );
    }
}
