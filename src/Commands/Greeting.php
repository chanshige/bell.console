<?php
declare(strict_types=1);

namespace Bell\Console\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Greeting
 *
 * @package Bell\Console\Commands
 */
class Greeting extends AbstractCommand
{
    protected static $defaultName = 'sample:greeting';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello!');

        return 0;
    }
}
