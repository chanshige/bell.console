<?php

namespace Bell\AuraDi;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Bell\Console\Commands\Greeting;

use Throwable;

/**
 * Class Resolve
 *
 * @package Bell\AuraDi
 */
class Resolve extends ContainerConfig
{
    /**
     * {@inheritDoc}
     * @throws Throwable
     */
    public function define(Container $di): void
    {
        $di->set(Greeting::class, $di->lazyNew(Greeting::class));
    }
}
