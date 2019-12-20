<?php

namespace Bell\Console\Interfaces;

use ArrayIterator;

/**
 * Interface StorageInterface
 *
 * @package Bell\Console\Interfaces
 */
interface StorageInterface
{
    /**
     * @param mixed $value
     * @return self
     */
    public function append($value): self;

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param mixed $index
     * @return mixed
     */
    public function one($index);

    /**
     * @return mixed
     */
    public function first();

    /**
     * @return mixed
     */
    public function latest();

    /**
     * @param mixed $index
     * @return bool
     */
    public function exists($index);

    /**
     * @return ArrayIterator
     */
    public function iterator(): ArrayIterator;

    /**
     * @return int
     */
    public function size(): int;
}
