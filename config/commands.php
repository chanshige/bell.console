<?php

use Bell\Console\Commands as Command;
use Bell\Console\Services as Service;

use Goutte\Client;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

/**
 * Commands Lazily Loaded
 *
 * @var Application $app
 */
return function (Application $app) {
    $app->setCommandLoader(
        new FactoryCommandLoader(
            [
                Command\Greeting::getDefaultName() => function () {
                    return new Command\Greeting;
                },
                Command\HawksNews::getDefaultName() => function () {
                    return new Command\HawksNews((new Service\HawksNewsScraper())(new Client));
                }
            ]
        )
    );
};
