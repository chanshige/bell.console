<?php
declare(strict_types=1);

namespace Bell\Console;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application as SymfonyConsole;

/**
 * Class App
 *
 * @package Bell\Console
 */
class App
{
    /** @var SymfonyConsole */
    private $app;

    /**
     * Application constructor.
     *
     * @param SymfonyConsole     $app
     * @param ContainerInterface $container
     */
    public function __construct(
        SymfonyConsole $app,
        ContainerInterface $container
    ) {
        $commands = (require CONSOLE_DIR . 'config/commands.php');
        $commands($app, $container);

        $this->app = $app;
    }

    /**
     * Return an instance.
     *
     * @return SymfonyConsole
     */
    public function boot()
    {
        return $this->app;
    }
}
