<?php
date_default_timezone_set('Asia/Tokyo');

require_once __DIR__ . '/vendor/autoload.php';

use Bell\Console\{App, ContainerFactory};
use Dotenv\Dotenv;
use Symfony\Component\Console\Application as SfConsole;

const CONSOLE_DIR = __DIR__ . '/';

try {
    (Dotenv::createImmutable(CONSOLE_DIR))->load();

    $app = new App(
        new SfConsole(
            env('CONSOLE_NAME'),
            env('CONSOLE_VERSION')
        ),
        (new ContainerFactory())->build()
    );

    $app->boot()->run();

    exit(0);
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}
