<?php

namespace Bell\AuraDi;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Bell\Console\Http\GoutteClient;
use Bell\Console\Interfaces\GoutteClientInterface;
use Bell\Console\Interfaces\HawksNewsScraperInterface;
use Bell\Console\Services\HawksNewsScraper;
use Chanshige\Interfaces\SlackNotifierInterface;

use Chanshige\SlackNotifier;

/**
 * Class Common
 *
 * @package Bell\AuraDi
 */
class Common extends ContainerConfig
{
    /**
     * {@inheritDoc}
     */
    public function define(Container $di): void
    {
        $di->types[GoutteClientInterface::class] = $di->lazyNew(GoutteClient::class);
        $di->types[SlackNotifierInterface::class] = $di->lazyNew(
            SlackNotifier::class,
            [getenv('SLACK_WEBHOOK_URI')]
        );

        $di->types[HawksNewsScraperInterface::class] = $di->lazyNew(HawksNewsScraper::class);
    }
}
