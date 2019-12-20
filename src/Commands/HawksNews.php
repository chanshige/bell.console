<?php
declare(strict_types=1);

namespace Bell\Console\Commands;

use Bell\Console\Interfaces\ScraperInterface;
use Bell\Console\Supports\Storage;
use Chanshige\Interfaces\SlackNotifierInterface;
use Chanshige\Messages\SlackAttachment;
use Chanshige\Messages\SlackMessage;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HawksNews
 *
 * @package Bell\Console\Commands
 */
class HawksNews extends AbstractCommand
{
    /** @var string  command name */
    protected $command = 'hawks:news';

    /** @var string  command description */
    protected $description = 'HAWKS NEWS';

    /** @var ScraperInterface */
    private $service;

    /** @var SlackNotifierInterface */
    private $notifier;

    /**
     * HawksNews constructor.
     *
     * @param ScraperInterface       $service
     * @param SlackNotifierInterface $notifier
     */
    public function __construct(
        ScraperInterface $service,
        SlackNotifierInterface $notifier
    ) {
        parent::__construct();
        $this->service = $service;
        $this->notifier = $notifier;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->service->scraping($storage = new Storage());

        if ($input->getOption('notify')) {
            $this->notifier->send($this->buildSlackMessage($storage->first()));
        }

        return 0;
    }

    /**
     * @param array $data
     * @return SlackMessage
     */
    protected function buildSlackMessage(array $data)
    {
        $message = (new SlackMessage())->username('HawksNews')
            ->channel(getenv('SLACK_HAWKS_NOTIFY_CHANNEL'))
            ->iconUrl(getenv('SLACK_HAWKS_NOTIFY_ICON_URL'))
            ->message('HAWKS NEWS (' . $data['date'] . ')');

        foreach ($data['article'] as $list) {
            $message->attachments(
                [
                    (new SlackAttachment())->color('#f9ca00')
                        ->authorName(implode("/", $list['label']))
                        ->title($list['title'])
                        ->titleLink($list['_links']['self']['href'])
                        ->message($list['description'])
                        ->thumbUrl($list['_links']['image']['href'])
                        ->footer('Fukuoka SoftBank HAWKS')
                        ->footerIcon(getenv('SLACK_HAWKS_NOTIFY_FOOTER_ICON'))
                ]
            );
        }

        return $message;
    }
}
