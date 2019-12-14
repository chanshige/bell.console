<?php
declare(strict_types=1);

namespace Bell\Console\Commands;

use Bell\Console\Interfaces\HawksNewsScraperInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HawksNews
 *
 * @package Bell\Console\Commands
 */
class HawksNews extends AbstractCommand
{
    /** @var HawksNewsScraperInterface */
    private $news;

    protected static $defaultName = 'hawks:news';

    public function __construct(HawksNewsScraperInterface $news)
    {
        parent::__construct();
        $this->news = $news;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        var_export(($this->news)->latest());

        return 0;
    }
}
