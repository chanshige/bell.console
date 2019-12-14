<?php

namespace Bell\Console\Interfaces;

use Goutte\Client;
use ArrayIterator;

/**
 * Interface HawksNewsScraperInterface
 *
 * @package Bell\Console\Interfaces
 */
interface HawksNewsScraperInterface
{
    /**
     * @param Client $client
     * @return HawksNewsScraperInterface
     */
    public function __invoke(Client $client): HawksNewsScraperInterface;

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
    public function size();
}
