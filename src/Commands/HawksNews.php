<?php
declare(strict_types=1);

namespace Bell\Console\Commands;

use Bell\Console\Interfaces\HawksNewsScraperInterface;
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
    protected $description = 'SoftBank HAWKS NEWS';

    /** @var HawksNewsScraperInterface */
    private $service;

    /** @var SlackNotifierInterface */
    private $notifier;

    /**
     * HawksNews constructor.
     *
     * @param HawksNewsScraperInterface $service
     * @param SlackNotifierInterface    $notifier
     */
    public function __construct(
        HawksNewsScraperInterface $service,
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
        var_dump(($this->service)()->latest());
        $this->notifier->send($this->buildSlackMessage(($this->service)()->latest()));
        return 0;
    }

    /**
     * @param array $data
     * @return SlackMessage
     */
    private function buildSlackMessage(array $data)
    {
        $message = (new SlackMessage())->username('HawksNews')
            ->iconUrl('https://pbs.twimg.com/profile_images/1186986092609695744/L6ql63Nx_400x400.jpg')
            ->message('福岡ソフトバンクホークス(公式)の新しいニュースがあります(' . $data['date'] . ')');

        $attachment = [];
        foreach ($data['article'] as $list) {
            $attachment[] = (new SlackAttachment())->color('#f9ca00')
                ->title($list['title'])
                ->titleLink($list['href'])
                ->footer('Fukuoka SoftBank HAWKS')
                ->footerIcon('https://www.softbankhawks.co.jp//news/pl_img/logo02.jpg');
        }

        return $message->attachments($attachment);
    }
}
