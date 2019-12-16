<?php
declare(strict_types=1);

namespace Bell\Console\Commands;

use Symfony\Component\Console\Command\Command;

/**
 * Class AbstractCommand
 *
 * @package Bell\Console\Commands
 */
abstract class AbstractCommand extends Command
{
    /** @var string  command name */
    protected $command = '';

    /** @var string  command description */
    protected $description = '';

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName($this->command);
        $this->setDescription($this->description);
    }
}
