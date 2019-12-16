<?php

use Bell\Console\Commands as Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

use Psr\Container\ContainerInterface;

/**
 * Commands Lazily Loaded
 *
 * @param Application        $app
 * @param ContainerInterface $c
 */
return function (Application $app, ContainerInterface $c) {
    $app->setCommandLoader(
        new FactoryCommandLoader(
            [
                'sample:greeting' => function () use ($c) {
                    return $c->get(Command\Greeting::class);
                }
            ]
        )
    );
};
