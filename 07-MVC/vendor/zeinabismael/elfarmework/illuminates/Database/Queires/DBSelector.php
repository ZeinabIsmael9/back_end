<?php

namespace Illuminates\Database\Queires;

use Illuminates\Database\Queires\Collection;
use Illuminates\Pagination\Paginator;

trait DBSelector
{
    /**
     * Find a model by its primary key.
     *
     * @param  int  $id  The primary key of the model.
     * @return static|null The model instance if found, otherwise null.
     */

    public static function find(int $id): ?static
    {
        return static::where('id', '=', $id)->first();
    }


    /**
     * Retrieve the first model matching the query criteria.
     *
     * @return static|null
     */
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

    /**
     * Retrieve all models matching the query criteria.
     *
     * @param  array|null  $columns
     * @return \Illuminates\Database\Queires\Collection|null
     */
    public static function get(null|array $columns = [], ?int $limit = null, ?int $offset = null): ?Collection
    {
        $query = static::buildSelectQuery($columns, $limit, $offset);
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetchAll(static::getDBConf()->FETCH_MODE);
        if ($data) {
            return new Collection($data);
        }
        return null;
    }

    /**
     * Retrieve all models matching the query criteria.
     *
     * @return null|array
     */
    public static function all(): null|array
    {
        return static::get();
    }

    public static function paginate(int $prePage = 10): ?Paginator
    {
        $page = (int) request('page', 1);
        $prePage = (int) request('pre_page', $prePage);
        $offset = ($page - 1) * $prePage;
        $collection = static::get([], $prePage, $offset);
        $total = static::count();
        return new Paginator(data: $collection, total: $total, currentpage: $page, perPage: $prePage);
    }
    /**
     * Get the number of models matching the query criteria.
     *
     * @return int
     */
    public static function count(): int
    {
        $query = "SELECT COUNT(*) as count FROM " . static::getTable();
        if (static::$condations) {
            $condations = array_map(fn($condation) => "{$condation['column']} {$condation['operator']} ?", static::$condations);
            $query .= '  WHERE  ' . implode(' AND ', $condations);
        }
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetch(static::getDBConf()->FETCH_MODE);
        return $data->count ?? 0;
    }
}
