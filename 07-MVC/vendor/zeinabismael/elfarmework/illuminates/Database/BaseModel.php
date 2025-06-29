<?php

namespace Illuminates\Database;

use Illuminates\Database\Contracts\DatabaseConnectionInterface;
use PDO;

abstract class BaseModel
{
    protected static PDO $db;
    protected  $table;
    protected static $attributes = [];
    public function __construct(DatabaseConnectionInterface $connect)
    {
        self::$db = $connect->getPDO();
    }

    public static function getDBConf(): object
    {
        $driver = config('database.driver');
        return (object) config("database.drivers")[$driver];
    }


    public static function setAttributes( $attributes)
    {
        self::$attributes = $attributes;
    }

    

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function __set($name, $value): void
    {
        self::$attributes[$name] = $value;
    }
    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $name
     * @return mixed
     */
    public function __get($name): mixed
    {
        return self::$attributes[$name] ?? null;
    }
}
