<?php

namespace Bell\Console\Interfaces;

use Closure;

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
     * @param StorageInterface $storage
     * @return void
     */
    public function scraping(StorageInterface $storage);
}
