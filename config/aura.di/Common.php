<?php

namespace Bell\AuraDi;

use Throwable;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Bell\Console\Commands\{Greeting, HawksNews};
use Bell\Console\Http\GoutteClient;
use Bell\Console\Interfaces\GoutteClientInterface;
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
     * @throws Throwable
     */
    public function define(Container $di): void
    {
        // global depends
        $di->types[GoutteClientInterface::class] = $di->lazyNew(GoutteClient::class);
        $di->types[SlackNotifierInterface::class] = $di->lazyNew(SlackNotifier::class, [getenv('SLACK_WEBHOOK_URI')]);

        // dep injects
        $di->params[HawksNews::class]['service'] = $di->lazyNew(HawksNewsScraper::class);

        // set command
        $di->set(Greeting::class, $di->lazyNew(Greeting::class));
        $di->set(HawksNews::class, $di->lazyNew(HawksNews::class));
    }
}
