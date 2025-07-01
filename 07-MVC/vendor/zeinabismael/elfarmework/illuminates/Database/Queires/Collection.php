<?php
namespace Illuminates\Database\Queires;

class Collection implements \IteratorAggregate, \Countable
{
    public function __construct( protected array $items)
    {
        $this->items = $items;
    }

    public function getIterator():\ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    public function count():int
    {
        return count($this->items);
    }

    public function toArray():array
    {
        return array_map(
            function ($item) {
                return get_object_vars($item);
            },
            $this->items
        );
    }
}
