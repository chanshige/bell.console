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
    /** @var string */
    protected $command = 'sample:greeting';

    /** @var string */
    protected $description = 'greeting!';

    /** @var SlackNotifierInterface */
    private $notifier;

    /**
     * Greeting constructor.
     *
     * @param SlackNotifierInterface $notifier
     */
    public function __construct(SlackNotifierInterface $notifier)
    {
        parent::__construct();
        $this->notifier = $notifier;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $greeting = 'Hello!';

        $output->writeln($greeting);

        if ($input->getOption('notify')) {
            $this->notifier->send((new SlackMessage())->message($greeting));
        }

        return 0;
    }
}
