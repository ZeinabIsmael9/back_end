<?php

namespace Illuminates\Database\Queires;

use Illuminates\Database\Queires\Collection;
trait DBSelector
{
    public static function find(int $id): ?static
    {
        return static::where('id', '=', $id)->first();
    }


    public static function first(): ?static
    {
        $query = static::buildSelectQuery();
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetch(static::getDBConf()->FETCH_MODE);
        if ($data) {
            //  var_dump($data);
            static::setAttributes($data);
            return new static;
        }
        return null;
    }

    public static function get(null|array $columns = []): ?Collection
    {
        $query = static::buildSelectQuery($columns);
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetchAll(static::getDBConf()->FETCH_MODE);
        if ($data) {
            return new Collection($data);
        }
            return null;
        }

    public static function all(): null|array
    {
        return static::get();
    }
}
