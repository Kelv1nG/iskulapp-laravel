<?php

namespace App\DataHandlers\Exceptions;

use Exception;
use Throwable;

class NoTableException extends Exception
{
    public function __construct($table, $message = '', $code = 0, ?Throwable $previous = null)
    {
        $message = "No handler found for table: $table";
        parent::__construct($message, $code, $previous);
    }
}
