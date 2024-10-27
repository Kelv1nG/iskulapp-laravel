<?php

namespace App\DataHandlers;

abstract class BaseHandler
{
    abstract public static function upsert($data);

    abstract public static function update($data);

    abstract public static function delete($data);

    public static function handle($method, $data)
    {
        switch ($method) {
            case 'PUT':
                self::upsert($data);
            case 'PATCH':
                self::update($data);
            case 'DELETE':
                self::delete($data);
        }
    }
}
