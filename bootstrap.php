<?php
date_default_timezone_set('Asia/Tokyo');

require_once __DIR__ . '/vendor/autoload.php';

use Bell\Console\{App, ContainerFactory};
use Dotenv\Dotenv;
use Symfony\Component\Console\Application as SfConsole;

const CONSOLE_DIR = __DIR__ . '/';

try {
    /* load dotenv */
    (Dotenv::createImmutable(CONSOLE_DIR))->load();

    /* build container */
    $container = (new ContainerFactory())->build();

    /* boot application */
    $app = new App(
        new SfConsole(
            getenv('CONSOLE_NAME'),
            getenv('CONSOLE_VERSION')
        ),
        $container
    );

    $app->boot()->run();

    exit(0);
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}
