<?php

namespace Illuminates\Database\Queires;

trait DBCondations
{
    protected static array $condations = [];
    protected static array $columns = ['*'];
    /**
     * Add a basic where clause to the query.
     *
     * @param  string  $column
     * @param  string  $operator
     * @param  string  $value
     * @return self
     */
    public static function where(string $column, string $operator, string $value): self
    {
        self::$condations[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];
        return new self;
    }

    /**
     * Builds and returns a SELECT SQL query string based on the specified columns and conditions.
     *
     * The query selects the specified columns from the table associated with the parent class.
     * If conditions are present, a WHERE clause is appended with conditions joined by AND.
     *
     * @return string The constructed SQL SELECT query string.
     */

    public static function buildSelectQuery(): string
    {
        $columns = implode(',', static::$columns);
        $query = "SELECT {$columns} FROM " . parent::$table;
        if (static::$condations) {
            $condations = array_map(fn($condation) => "{$condation['column']} {$condation['operator']} ?", static::$condations);
            $query .= ' WHERE ' . implode(' AND ', $condations);
        }
        return $query;
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
