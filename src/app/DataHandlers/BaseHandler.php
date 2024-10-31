<?php

namespace App\DataHandlers;

abstract class BaseHandler
{
    public static function handle(string $method, array $data)
    {
        switch ($method) {
            case 'PUT':
                return static::upsert($data);
            case 'PATCH':
                return static::update($data);
            case 'DELETE':
                return static::delete($data);
            default:
                throw new \Exception("Unsupported method: {$method}");
        }
    }

    abstract public static function upsert(array $data);

    abstract public static function update(array $data);

    abstract public static function delete(array $data);
}
