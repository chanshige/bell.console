<?php

namespace Bell\Console\Interfaces;

use ArrayIterator;

/**
 * Interface ScraperInterface
 *
 * @package Bell\Console\Interfaces
 */
interface ScraperInterface
{
    /**
     * HawksNewsScraperInterface constructor.
     *
     * @param GoutteClientInterface $client
     */
    public function __construct(GoutteClientInterface $client);

    /**
     * @return $this
     */
    public function __invoke();

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return array
     */
    public function latest(): array;

    /**
     * @return ArrayIterator
     */
    public function iterator();

    /**
     * @return int
     */
    public function size(): int;
}
