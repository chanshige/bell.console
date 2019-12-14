<?php
declare(strict_types=1);

namespace Bell\Console\Services;

use ArrayObject;
use Bell\Console\Interfaces\HawksNewsScraperInterface;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class HawksNewsScraper
 *
 * @package Bell\Console\Services
 */
class HawksNewsScraper extends ArrayObject implements HawksNewsScraperInterface
{
    /**
     * Execute
     *
     * @param Client $client
     * @return HawksNewsScraperInterface
     */
    public function __invoke(Client $client): HawksNewsScraperInterface
    {
        $crawler = $client->request('GET', 'https://www.softbankhawks.co.jp/news/list/index.html');
        $section = $crawler->filter('section');
        $date = $section->filter('.pl_titleWrap03 > h2')->text();

        $section->filter('.pl_newsList02 > li')->each(function (Crawler $node) use ($date) {
            $news = [];
            $news['date'] = $date . $node->filter('.pl_date > p')->eq(0)->text() . '日';
            $news['article'] = $node->filter('ul > li')->each(function (Crawler $node) {
                $pl_text = $node->filter('.pl_text');
                $labels = $pl_text->filter('.pl_labelIconBl01');
                $a = $pl_text->filter('a');

                return [
                    'label' => $labels->each(function (Crawler $node) {
                        return $node->text();
                    }),
                    'title' => $a->text(),
                    'link_uri' => $a->link()->getUri(),
                ];
            });

            self::append($news);
        });

        return $this;
    }

    public function all(): array
    {
        return iterator_to_array(self::getIterator());
    }

    public function latest(): array
    {
        return self::offsetGet(0);
    }

    public function iterator()
    {
        return self::getIterator();
    }

    public function size()
    {
        return self::count();
    }
}
