<?php

namespace Bell\AuraDi;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Bell\Console\Commands\Greeting;
use Bell\Console\Http\GoutteClient;
use Bell\Console\Interfaces\GoutteClientInterface;
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
    }
}
