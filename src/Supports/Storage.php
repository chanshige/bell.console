<?php

namespace Bell\Console\Supports;

use ArrayObject;
use Bell\Console\Interfaces\StorageInterface;

/**
 * Class Storage
 *
 * @package Bell\Console\Supports
 */
class Storage extends ArrayObject implements StorageInterface
{
    /**
     * AbstractStorage constructor.
     *
     * @param array $input
     */
    public function __construct($input = [])
    {
        parent::__construct($input, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * {@inheritDoc}
     */
    public function append($value): StorageInterface
    {
        parent::append($value);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return iterator_to_array(self::getIterator());
    }

    /**
     * {@inheritDoc}
     */
    public function one($index)
    {
        return parent::offsetGet($index);
    }

    /**
     * {@inheritDoc}
     */
    public function latest()
    {
        return parent::offsetGet(($this->size() - 1));
    }

    /**
     * {@inheritDoc}
     */
    public function first()
    {
        return parent::offsetGet(0);
    }

    /**
     * {@inheritDoc}
     */
    public function size(): int
    {
        return parent::count();
    }

    /**
     * {@inheritDoc}
     */
    public function exists($index)
    {
        return parent::offsetExists($index);
    }

    /**
     * {@inheritDoc}
     */
    public function iterator(): \ArrayIterator
    {
        return parent::getIterator();
    }
}
