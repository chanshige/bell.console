<?php
declare(strict_types=1);

namespace Bell\Console;

use Symfony\Component\Console\Application as SymfonyConsole;

/**
 * Class Application
 *
 * @package Bell\Console
 */
class Application
{
    private $app;

    /**
     * Application constructor.
     *
     * @param SymfonyConsole $app
     */
    public function __construct(SymfonyConsole $app)
    {
        $commands = (require CONSOLE_DIR . 'config/commands.php');
        $commands($app);

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
