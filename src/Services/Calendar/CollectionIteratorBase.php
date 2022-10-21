<?php
namespace Schulleri\Salaryculator\Services\Calendar;

use DateTimeImmutable;
use Iterator;

/**
 * Class CollectionIteratorBase
 * @package Schulleri\Salaryculator\Services\Collection
 */
abstract class CollectionIteratorBase implements Iterator
{
    /** @var int */
    protected $position = 0;

    /** @var array */
    protected $collection = [];

    /**
     *
     */
    public function rewind() :void
    {
        $this->position = 0;
    }

    /**
     * @return DateTimeImmutable
     */
    public function current(): DateTimeImmutable
    {
        return $this->collection[$this->position];
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     *
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return array_key_exists($this->position, $this->collection);
    }
}
