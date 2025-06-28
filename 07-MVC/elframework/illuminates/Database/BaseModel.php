<?php

namespace Illuminates\Database;

use Illuminates\Database\Contracts\DatabaseConnectionInterface;
use Illuminates\Database\Queires\DBCondations;
use PDO;

abstract class BaseModel
{
    use DBCondations;
    protected PDO $db;
    protected static $table;
    protected $attributes = [];
    public function __construct(DatabaseConnectionInterface $connect)
    {
        $this->db = $connect->getPDO();
        if ($this->table === null) {
            $this->table = strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
        }
        // var_dump($this->table);
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
        $this->attributes[$name] = $value;
    }
    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $name
     * @return mixed
     */
    public function __get($name): mixed
    {
        return $this->attributes[$name] ?? null;
    }
}
