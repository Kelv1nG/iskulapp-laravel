<?php

namespace App\Models\Traits;

trait TableName
{
    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }
}
