<?php

namespace Illuminates\Database;

use Illuminates\Database\Drivers\MySQLConnection;
use Illuminates\Database\Drivers\SQLiteConnection;
use Illuminates\Database\Queires\DBCondations;
use Illuminates\Database\Queires\DBSelector;
use Illuminates\Logs\Log;

class Model extends BaseModel
{
    use DBCondations, DBSelector;
    public function __construct()
    {
        $config = config('database.driver');
        if ($config == 'mysql') {
            parent::__construct(new MySQLConnection());
        } elseif ($config == 'sqlite') {
            parent::__construct(new SQLiteConnection());
        } else {
            throw new Log('Database driver not found');
        }
    }

    public static function getTable()
    {
        $class = new static;
        if ($class->table === null) {
            $class->table = strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
        }
        return $class->table;
    }

    public function toArray()
        {
            return (array) static::$attributes;
        }
    
}
