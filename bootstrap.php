<?php
date_default_timezone_set('Asia/Tokyo');

require_once __DIR__ . '/vendor/autoload.php';

use Aura\Di\ContainerBuilder;
use Bell\AuraDi\{Common, Resolve};

use Bell\Console\App;
use Dotenv\Dotenv;
use Symfony\Component\Console\Application as SfConsole;

const CONSOLE_DIR = __DIR__ . '/';

try {
    /* Load dotenv */
    (Dotenv::createImmutable(CONSOLE_DIR))->load();

    /* boot application */
    $app = new App(
        new SfConsole(getenv('CONSOLE_NAME'), getenv('CONSOLE_VERSION')),
        (new ContainerBuilder())->newConfiguredInstance([Common::class, Resolve::class], true)
    );
    $app->boot()->run();

    exit(0);
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}
