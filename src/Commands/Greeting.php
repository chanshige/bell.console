<?php
declare(strict_types=1);

namespace Bell\Console\Commands;

use Chanshige\Interfaces\SlackNotifierInterface;
use Chanshige\Messages\SlackMessage;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Greeting
 *
 * @package Bell\Console\Commands
 */
class Greeting extends AbstractCommand
{
    protected $command = 'sample:greeting';

    protected $description = 'greeting!';

    private $notifier;

    public function __construct(SlackNotifierInterface $notifier)
    {
        parent::__construct();
        $this->notifier = $notifier;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello!');
        $this->notifier->send((new SlackMessage())->message('Hello!'));

        return 0;
    }
}
