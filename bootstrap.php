<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bell\Console\Application;
use Symfony\Component\Console\Application as SfConsole;

const CONSOLE_DIR = __DIR__ . '/';
const CONSOLE_NAME = 'bell.console';
const CONSOLE_VERSION = 'v0.1.0';

try {
    $app = (new Application(new SfConsole(CONSOLE_NAME, CONSOLE_VERSION)))->boot();
    $app->run();

    exit(0);
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}
