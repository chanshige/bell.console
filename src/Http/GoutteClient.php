<?php
declare(strict_types=1);

namespace Bell\Console\Http;

use Bell\Console\Interfaces\GoutteClientInterface;
use Goutte\Client;
use Symfony\Component\DomCrawler\Link;

/**
 * Class GoutteClient
 *
 * @package Bell\Console\Http
 */
class GoutteClient implements GoutteClientInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * GoutteClient constructor.
     */
    public function __construct()
    {
        // Goutte/Clientにガッツリ依存する
        $this->client = new Client;
    }

    /**
     * {@inheritDoc}
     */
    public function setServerParameters(array $server)
    {
        $this->client->setServerParameters($server);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setHeader($name, $value)
    {
        $this->client->setHeader($name, $value);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAuth($user, $password = '', $type = 'basic')
    {
        $this->client->setAuth($user, $password, $type);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function request(string $method, string $uri, array $parameters = [])
    {
        return $this->client->request($method, $uri, $parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function click(Link $link)
    {
        return $this->client->click($link);
    }
}
