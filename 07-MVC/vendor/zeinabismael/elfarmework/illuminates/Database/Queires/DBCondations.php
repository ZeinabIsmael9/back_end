<?php

namespace Illuminates\Database\Queires;

trait DBCondations
{
    protected static array $condations = [];
    protected static array $columns = ['*'];
    protected static ?int $limit = null;
    protected static ?int $offset = null;
    protected static ?int $take = null;
    /**
     * Add a basic where clause to the query.
     *
     * @param  string  $column
     * @param  string  $operator
     * @param  string  $value
     * @return static
     */
    public static function where(string $column, string $operator, string $value = ''): static
    {
        $my_operator = in_array($operator, ['=', 'LIKE']);
        static::$condations[] = [
            'column' => $column,
            'operator' => $my_operator ? $operator : '=',
            'value' => !$my_operator ? $value :  $value,
        ];
        return new static;
    }


    /**
     * Set the limit for the query.
     *
     * @param  int  $limit
     * @return static
     */
    public static function limit(int $limit): static
    {
        static::$limit = $limit;
        return new static;
    }
    /**
     * Set the offset for the query.
     *
     * @param  int  $offset
     * @return static
     */

    public static function offset(int $offset): static
    {
        static::$offset = $offset;
        return new static;
    }


    public static function take(int $take): static
    {
        static::$take = $take;
        return new static;
    }

    /**
     * Build the select query for the current query.
     *
     * @return string The select query.
     */
    public static function buildSelectQuery(): string
    {
        $table = static::getTable();
        $columns = implode(',', static::$columns);
        $query = "SELECT {$columns} FROM " . $table;
        if (static::$condations) {
            $condations = array_map(fn($condation) => "{$condation['column']} {$condation['operator']} ?", static::$condations);
            $query .= '  WHERE  ' . implode(' AND ', $condations);
        }

        if (!is_null(static::$limit)) {
            $query .= ' LIMIT ' . static::$limit;
        }

        if (!is_null(static::$offset)) {
            $query .= ' OFFSET ' . static::$offset;
        }
        return $query;
    }


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

    /**
     * Returns an array of values for the conditions that are present in the query.
     *
     * @return array The values for the conditions.
     */
    public static function getCondationValues(): array
    {
        return array_map(fn($condation) => $condation['value'], static::$condations);
    }
}
