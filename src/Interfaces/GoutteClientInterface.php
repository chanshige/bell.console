<?php

namespace Bell\Console\Interfaces;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Interface GoutteClientInterface
 *
 * @package Bell\Console\Interfaces
 */
interface GoutteClientInterface
{
    /**
     * @param array $server
     * @return GoutteClientInterface
     */
    public function setServerParameters(array $server);

    /**
     * @param mixed $name
     * @param mixed $value
     * @return GoutteClientInterface
     */
    public function setHeader($name, $value);

    /**
     * @param mixed  $user
     * @param string $password
     * @param string $type
     * @return GoutteClientInterface
     */
    public function setAuth($user, $password = '', $type = 'basic');

    /**
     * Calls a URI.
     *
     * @param string $method     The request method
     * @param string $uri        The URI to fetch
     * @param array  $parameters The Request parameters
     * @return Crawler
     */
    public function request(string $method, string $uri, array $parameters = []);
}
