<?php

use Bell\Console\Commands as Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

use Psr\Container\ContainerInterface;

/**
 * Commands Lazily Loaded
 *
 * @param Application        $app
 * @param ContainerInterface $container
 */
return function (Application $app, ContainerInterface $container) {
    $app->setCommandLoader(
        new FactoryCommandLoader(
            [
                'sample:greeting' => function () use ($container) {
                    return $container->get(Command\Greeting::class);
                }
            ]
        )
    );
};
